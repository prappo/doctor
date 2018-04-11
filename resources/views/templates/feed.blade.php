@if(isset($data['feed']))
    @foreach($data['feed']['data'] as $key => $value)

        @if(isset($value['message']))
            <div class="box box-primary">
                <div class="box-header with-border">
                    <kbd class="pull-right">{{\Carbon\Carbon::parse($value['created_time'])->diffForHumans()}}</kbd>
                    @if(isset($value['link']))
                        <div class="pull-left">

                            Quick Share :


                            <a target="_top"
                               onclick="window.open('https://plus.google.com/share?url={{$value['link']}}', 'newwindow', 'width=500, height=300'); return false;"
                               href="https://plus.google.com/share?url={{$value['link']}}"
                               class='btn-box-tool'><i
                                        class='fa fa-google-plus'></i></a>
                            <a target="_top"
                               onclick="window.open('https://www.linkedin.com/cws/share?url={{$value['link']}}', 'newwindow', 'width=500, height=300'); return false;"
                               href="https://www.linkedin.com/cws/share?url={{$value['link']}}"
                               class='btn-box-tool'><i
                                        class='fa fa-linkedin'></i></a>
                            <a target="_top"
                               onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{$value['link']}}', 'newwindow', 'width=500, height=300'); return false;"
                               href="https://www.facebook.com/sharer/sharer.php?u={{$value['link']}}"
                               class='btn-box-tool'><i
                                        class='fa fa-facebook'></i></a>
                            <a target="_top"
                               onclick="window.open('http://www.reddit.com/submit?url={{$value['link']}}', 'newwindow', 'width=500, height=300'); return false;"
                               href="http://www.reddit.com/submit?url={{$value['link']}}"
                               class='btn-box-tool'><i
                                        class='fa fa-reddit'></i></a>

                        </div>
                    @endif
                </div>
                <div class="box-body">
                    <h4>{{\Carbon\Carbon::parse($value['created_time'])->format('jS \o\f F, Y g:i:s a')}}</h4>
                    <p>
                    <h3><b>{{$value['message']}} </b></h3></p>
                </div>

                <div class="box-footer">
                    @if(isset($value['link']))
                        <a href="{{$value['link']}}" class="btn btn-success btn-xs" target="_blank"><i
                                    class="fa fa-external-link"></i> Link</a>
                    @endif
                </div>
            </div>

        @endif
    @endforeach

@endif