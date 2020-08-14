<ul class="cbp_tmtimeline">
    @foreach ($ordertimeline as $timeline )
    <li>
  
        <time class="cbp_tmtime" datetime="{{ $timeline->timelinedate }}"><span>      {{ date('H:i', strtotime($timeline->timelinedate)) }}</span> <span>      {{ date('j F, Y', strtotime($timeline->timelinedate)) }}</span></time>
        <div class="cbp_tmicon" style="background:{{ $timeline->color }};color:#fff"><i class="fa fa-{{ $timeline->icon   }}"></i></div>
        <div class="cbp_tmlabel"><h2>{{ $timeline->timeline_remark }}</h2>
            @if(!empty($timeline->remark))
            @php
                $timelinetxt = unserialize($timeline->remark);
            @endphp
            @endif
        
            <div class="timelinetext">{{ $timelinetxt['message'] }}</div>
            <div class="timelinefile"> <a target="_blank" href="{{ url('public/documents/orders',$timeline->order_id) }}/{{ $timelinetxt['pdf'] }}">
                <img src="{{ asset('assets/images/pdf.png') }}" alt=""></a></div>
        </div>
    </li>   
    @endforeach
</ul>