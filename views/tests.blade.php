<style>
    .passed {
        color: green;
    }

    .failed {
        color: red;
    }
</style>

@foreach ($tests as $test => $results)
    <h2>{{ $test }}<h2>

            @if ($results)
                <div class='passed'>PASSED</div>
            @else
                <div class='failed'>FAILED</div>
            @endif
@endforeach
