@extends('layouts.app')

@section('content')
    <div class="chat">
    
      <div class="chat-history">
        <ul id="message-container">
          
          
        </ul>
      </div> <!-- end chat-history -->
      
      <form id="form_send_new_message" method="POST" action="{{ route('makeMessage') }}">
            {{ csrf_field() }}
          <div class="chat-message clearfix">
          <!-- <input type="text" name="message" class="form-control"> -->
            <textarea name="message" id="message-to-send" placeholder ="Type your message" rows="1"></textarea>
                    
            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
            <i class="fa fa-file-image-o"></i>
            
            <!-- <input type="submit" name="" value="send" class="btn btn-default"> -->
            <button type='submit'>Send</button>

          </div> <!-- end chat-message -->
      </form>
    
    </div> <!-- end chat -->
    
    
@endsection

@section('scripts')
    <script type="text/javascript">
    $(document).ready(function(){
        function updateView(){
          $.ajaxq('updateView',{
                url: "{{ route('getMessage') }}",
                type: "GET",                          
                data: new FormData(this),               
                contentType: false,                     
                cache: false,                           
                processData:false,
                success: function(data){
                    $("#message-container").html(data);
                    $('.chat-history').animate({scrollTop: $("#message-container").height()+100},0);
                },complete: function(){
                    $.ajaxq.clear('updateView ');
                }
            });
        }
        updateView();
        setInterval(function(){
          updateView();
        },500);
        $("#form_send_new_message").on("submit",function(e){
            e.preventDefault();
            // alert("Asdasd");
            $.ajaxq('form-submit',{
                url: "{{ route('makeMessage') }}",
                type: "POST",                          
                data: new FormData(this),               
                contentType: false,                     
                cache: false,                           
                processData:false,
                success: function(data){
                    if(data.error){
                        alert(data.stack_trace);
                    } else {
                        updateView();
                        
                        $("#message-to-send").val("");
                        $.ajaxq.clear('form-submit');
                        
                    }
                },complete: function(){
                    $.ajaxq.clear('form-submit');
                }
            });
            
        });
    });
        
        
    </script>
@endsection