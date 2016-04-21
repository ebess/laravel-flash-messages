@if (flash()->has())
    @foreach (flash()->get() as $type => $messages)

        <div class="alert alert-{{$type}} alert-dismissible fade in">

            @if (config('flash-messages.closable'))
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            @endif

            <ul class="list list-unstyled">
                @foreach ($messages as $val)
                    <li>
                        @if (is_array($val))
                            @if (isset($val['title']))
                                <strong>{{$val['title']}}</strong>
                            @endif
                            {{$val['text']}}
                        @else
                            {{$val}}
                        @endif
                    </li>
                @endforeach
            </ul>

        </div>
    @endforeach
@endif
