# retry
Retry given callback after executing action callback

## Usage

retry_callback($callback, $action, [$times_to_repeat=1])

Returns result of first callback

If Exception is thrown in the first callback the action callback is called and original callback is repeated

If Exception is thrown after specified amount of retries the original exception is thrown
