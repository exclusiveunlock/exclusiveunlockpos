<?php

namespace App\Http\Controllers;

use App\Models\Firmware;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Mostrar formulario para crear reporte general
     */
    public function createGeneral()
    {
        $userReports = auth()->user()->reports()
            ->with('firmware')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('reports.create', compact('userReports'));
    }
    
    /**
     * Mostrar formulario para reportar un firmware específico
     */
    public function createForFirmware(Firmware $firmware)
    {
        $userReports = auth()->user()->reports()
            ->with('firmware')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('reports.create', compact('firmware', 'userReports'));
    }
    
    /**
     * Almacenar reporte general
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);
        
        $report = new Report();
        $report->user_id = auth()->id();
        $report->subject = $request->subject;
        $report->description = $request->description;
        $report->status = 'pending';
        
        // Subir imagen si existe
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
            $report->image_path = $imagePath;
        }
        
        $report->save();
        
        return redirect()->route('reports.index')
            ->with('success', 'Report submitted successfully. We will review it shortly.');
    }
    
    /**
     * Almacenar reporte de firmware específico
     */
    public function storeFirmwareReport(Request $request, Firmware $firmware)
    {
        $request->validate([
            'subject' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Verificar si el usuario ya reportó este firmware recientemente
        $existingReport = Report::where('user_id', auth()->id())
            ->where('firmware_id', $firmware->id)
            ->where('status', '!=', 'resolved')
            ->where('created_at', '>', now()->subDays(7))
            ->first();
            
        if ($existingReport) {
            return back()->with('error', 'You already reported this firmware recently. We are working on it.');
        }
        
        $report = new Report();
        $report->user_id = auth()->id();
        $report->firmware_id = $firmware->id;
        $report->subject = $request->subject;
        $report->description = $request->description;
        $report->status = 'pending';
        
        // Subir imagen si existe
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
            $report->image_path = $imagePath;
        }
        
        $report->save();
        
        return redirect()->route('firmware.show', $firmware->slug)
            ->with('success', 'Thank you for reporting. Our team will review this firmware.');
    }
    
    /**
     * Listar todos los reportes del usuario
     */
    public function index()
    {
        $userReports = auth()->user()->reports()
            ->with('firmware')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('reports.index', compact('userReports'));
    }
    
    /**
     * Mostrar un reporte específico
     */
    public function show(Report $report)
    {
        // Verificar que el reporte pertenezca al usuario autenticado o sea admin
        if ($report->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
        
        return view('reports.show', compact('report'));
    }
    
    /**
     * Actualizar el estado de un reporte (solo admin)
     */
    public function updateStatus(Request $request, Report $report)
    {
        // Verificar si es admin
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
        
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,rejected',
            'admin_response' => 'nullable|string|max:1000',
        ]);
        
        $report->status = $request->status;
        $report->admin_response = $request->admin_response;
        
        if ($request->status === 'resolved' || $request->status === 'rejected') {
            $report->resolved_at = now();
        }
        
        $report->save();
        
        return redirect()->route('admin.reports.show', $report)
            ->with('success', 'Report status updated successfully.');
    }
    
    /**
     * Eliminar un reporte (solo admin o el propio usuario)
     */
    public function destroy(Report $report)
    {
        // Verificar permisos
        if ($report->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
        
        // Eliminar la imagen asociada si existe
        if ($report->image_path && Storage::disk('public')->exists($report->image_path)) {
            Storage::disk('public')->delete($report->image_path);
        }
        
        $report->delete();
        
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.reports.index')
                ->with('success', 'Report deleted successfully.');
        }
        
        return redirect()->route('reports.index')
            ->with('success', 'Report deleted successfully.');
    }
    
    /**
     * Listar todos los reportes para admin
     */
    public function adminIndex(Request $request)
    {
        // Verificar si es admin
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
        
        $reports = Report::with(['user', 'firmware'])
            ->when($request->status, function($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->user_id, function($query, $userId) {
                $query->where('user_id', $userId);
            })
            ->when($request->search, function($query, $search) {
                $query->where('subject', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        
        return view('admin.reports.index', compact('reports'));
    }
    
    /**
     * Mostrar reporte para admin
     */
    public function adminShow(Report $report)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
        
        $report->load(['user', 'firmware']);
        
        return view('admin.reports.show', compact('report'));
    }
    
    /**
     * Responder a un reporte (admin)
     */
    public function adminRespond(Request $request, Report $report)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
        
        $request->validate([
            'response' => 'required|string|min:10|max:2000',
        ]);
        
        $report->admin_response = $request->response;
        $report->status = 'resolved';
        $report->resolved_at = now();
        $report->save();
        
        // Aquí podrías enviar un email al usuario notificando la respuesta
        
        return redirect()->route('admin.reports.show', $report)
            ->with('success', 'Response sent successfully.');
    }
}