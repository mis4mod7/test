@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $chatroom->name }}</div>

                    <div class="card-body">
                        <div class="chat-messages">
                            @foreach ($messages as $message)
                                <p>
                                    <strong style="color: brown">{{ isset($message->user->name) ? $message->user->name : '' }}</strong>
                                    {{ $message->content }}
                                </p>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-footer">
                        <form action="{{ route('chatroom.messages.store', $chatroom->id) }}" method="post">

                            @csrf
                            <div class="input-group">
                                <input type="text" name="content" class="form-control" placeholder="Type your message">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
            <script>
                var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                    encrypted: true
                });

                var channel = pusher.subscribe('chatroom-{{ $chatroom->id }}');
                channel.bind('new-message', function(data) {
                    var message = data.message;
                    var html = '<p><strong>' + message.user.name + ':</strong> ' + message.content + '</p>';
                    $('.chat-messages').append(html);
                });
            </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
