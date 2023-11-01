<div style="display: none;" wire:init="getAnnouncements">
    <script>
        document.addEventListener('livewire:initialized', () => {
            window.addEventListener('notificationClosed', (event) => {
                Livewire.dispatch('notification-closed', {
                    id: event.detail.id,
                });
            });
        })
    </script>
</div>
