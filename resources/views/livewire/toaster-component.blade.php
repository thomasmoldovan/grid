<div>
    @if($message)
        <script>
            showToast(
                "{{ $status }}",
                "{{ $title }}", 
                "{{ $message }}",
                true)
        </script>
    @endif
</div>
