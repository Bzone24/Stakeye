// Set the date we're counting down to

var enddatetimer=$('#endtime').val();

var countDownDate = new Date(enddatetimer).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  
  if(minutes<=0){ minutes=0; }
  if(seconds<=0){ seconds=0; }
  
  var h=hours;
  var dism=minutes;
  var diss=seconds;
  
  
  if(minutes<10){ dism="0"+minutes; }
  if(seconds<10){ diss="0"+seconds; }
  
  $('.counter').html(h+":"+dism+":"+diss);
  
    
  // If the count down is over, write some text 
  
 // alert(distance);
  
  if(minutes===0 && seconds<=30 && hours===0)
  {
      //alert("hello");
        $("body .arun").addClass("dis_able");
        
        var duration=$('#gameduration').val();
        var gameid=$('#gameid').val();
        
         $.post("gameresult.html",
      {
       duration: duration,
       gameid: gameid
      },
      function(data, status){
      
       // alert(data);
      });
        
        
        
  }
  
  
  if (distance <= 0) {
  //  clearInterval(x);
    
     
     
    // alert(duration);
     $.post("gametime.html",
      {
       duration: duration
      },
      function(data, status){
        //  alert("done");
          
        location.reload();
        
      });
    
    
   
  }
}, 1000);

