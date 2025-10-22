<div>
    <div>
        Game ID: {{ $gameId }}
    </div>

    <script>
        setInterval(() => {
            window.livewire.emit('generateGame');
        }, 1000);
    </script>
</div>
