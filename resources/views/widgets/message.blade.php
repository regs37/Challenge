@foreach($messages as $message)
<li class="clearfix">
    <div class="message-data @if($message->userid == $userid) align-right @endif">
      <span class="message-data-time" >{{ $message->created_at }}</span> &nbsp; &nbsp;
      <span class="message-data-name" >{{ $message->name }}</span> <i class="fa fa-circle me"></i>
      
    </div>
    <div class="message @if($message->userid == $userid) other-message float-right @else my-message float-left @endif ">
      {{ $message->message }}
    </div>
  </li>
 @endforeach