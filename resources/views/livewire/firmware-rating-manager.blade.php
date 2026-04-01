<div>
    <div class="flex items-center space-x-2">
        <span class="text-lg font-medium">Your rating:</span>
        <div class="flex">
            @for ($i = 1; $i <= 5; $i++)
                <button wire:click="setRating({{ $i }})"
                        class="text-2xl {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-400' }}">
                    ★
                </button>
            @endfor
        </div>
    </div>

    @error('rating') <span class="text-red-500">{{ $message }}</span> @enderror

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('rating-saved', (message) => {
                // Do something with the message, like showing a toast notification
                console.log(message);
            });
        });
    </script>
</div>