<div class="row flot-what">
<a href="https://t.me/goodluck4950" target="_blank"><img src="assets/front/images/ta.png" alt="Support telegram" /></a>
<a onClick="window.location.reload();" class="refresh-btn">REFRESH </a>
</div>

<div class="container-fluid">
<div class="row gold-footer">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="g-foot">
<br>
<div class="foot-cont">
<p style="padding-right: 10%; padding-left: 10%">Desclaimer: Purchase of online lottery using this website is prohibited in the territories where lotteries are banned. Playing online matka below 18 years is not acceptable. For Contact us on Click on Telegram icon .</p>
</div>
<p>Copy Right 2024</p>
</div>
</div>
</div>
</div>





<script src="assets/front/js/bundle.2704.js"></script>
<script type="text/javascript">

     
     $(document).ready(function(){
        $('.closebutn').click(function(){
          $('.overlay').fadeOut();
          $('.successmessage').fadeOut();
          $('.errormessage').fadeOut();
        });
      });
      
      $(document).ready(function(){
        $('.overlay').delay(1000).fadeOut();
        $('.successmessage').delay(1000).fadeOut();
        $('.errormessage').delay(1000).fadeOut();
      });

    </script>
<style>

    label.error{color:#dd0000;font-weight:normal;margin-bottom: 0px;}
  </style>
<script type="text/javascript">

  $("document").ready(function(){
	  
    $("#log_frm").validate({
      rules:{
        username:{
          "required":true
        },
         password: {
          required: true,
        }
      },
      messages:{
        username:{
          "required":"Please Enter Username..!!"
        },
        password:{
          "required":"Please Enter Password..!!"
        }
      }
    });
	
	$("#mob_frm").validate({
      rules:{
        mobile:{
          "required":true,
		  number: true
        },
         password: {
          required: true,
        }
      },
      messages:{
        mobile:{
          "required":"Please Enter Mobile..!!",
		  "number":"Please Enter a Valid Number..!!"
        },
        password:{
          "required":"Please Enter Password..!!"
        }
      }
    });

    $("#frgt_frm").validate({
      rules:{
        mobile: {
          required: true,
          number: true
        }
      },
      messages:{
        mobile:{
          "required":"Please Enter Mobile..!!",
          "number":"Please Enter a Valid Number..!!"
        }
      }
    });

    $("#otp_frm").validate({
      rules:{
      	otp: "required",
  	    password: "required",
  	    password_again: {
  	        equalTo: "#pass1"
  	    }
      },
      messages:{
        	"otp":"Please Enter OTP..!!",
          "password":"Please Enter Password..!!",
          "password_again":"Password and Confirm Password Must be Same..!!"
      }
    });

    $("#single_frm").validate({
      rules:{
        single_dropdown:{
          "required":true
        }
      },
      messages:{
        single_dropdown:{
          "required":"Please Select Market..!!"
        }
      },
      errorPlacement: function(error, element) {
        if(element.attr("name") == "single_dropdown") {
          error.insertAfter(".main-top");
        } else {
          error.insertAfter(element);
        }
      }
    });

    $("#starline_single_frm").validate({
      rules:{
        // single_dropdown:{
        //   "required":true
        // }
      },
      messages:{
        // single_dropdown:{
        //   "required":"Please Select Market..!!"
        // }
      },
      errorPlacement: function(error, element) {
        if(element.attr("name") == "single_dropdown") {
          error.insertAfter(".main-top");
        } else {
          error.insertAfter(element);
        }
      }
    });

    $("#jodi_frm").validate({
      rules:{
        jodi_dropdown:{
          "required":true
        }
      },
      messages:{
        jodi_dropdown:{
          "required":"Please Select Market..!!"
        }
      },
	  submitHandler: function(form) {
        var flag=0;flg=1;
        $( ".num" ).each(function( index ) {
          if($(this).hasClass("select-cls"))
          {
            flag=1;
          }
        });
        if(flag==0)
        {
          $(".number-area").after('<label id="jodi_dropdown-error" class="error" for="jodi_dropdown">Please Bet on a Number..!!</label>');
        }
        else
        {
          $( ".clone-class" ).each(function( index ) {
            if($( this ).find("input").val()=="")
            {
              flag=0;
            }
          });
          if(flag==0)
          {
            $(".show-input").after('<label id="jodi_select-error" class="error" for="jodi_select">Please Fill All the Amount Field..!!</label>');
            $("#jodi_dropdown-error").hide();
          }
        }
      }
    });

    $("#single_patti_frm").validate({
      rules:{
        single_patti_dropdown:{
          "required":true
        }
      },
      messages:{
        single_patti_dropdown:{
          "required":"Please Select Market..!!"
        }
      }
    });

    
    $("#double_patti_frm").validate({
      rules:{
        double_patti_dropdown:{
          "required":true
        }
      },
      messages:{
        double_patti_dropdown:{
          "required":"Please Select Market..!!"
        }
      }
    });

    
  $(document).on("click",".single-num",function(){
    if(!$(this).hasClass("select-cls")){
      var i=0;
      $( ".single_patti_box" ).each(function( index ) {
        i++
      });
      var t_bet=0;
         
      // if(parseInt(t_bet) + parseInt(i) >=100)
      // {
      //   swal("You Can Only Bet on 100 Single Patti Numbers Today");
      // }
      // else
      // {
        $(this).addClass("select-cls");
        var new_div= $("#clone-cls").clone().attr("id","").addClass("clone-class").removeAttr( "style" ).appendTo(".show-input");
        new_div.find(".b-num").html($(this).find("span").html());
        new_div.find("input").attr('name','quantity['+$(this).find("span").html()+']');
      // }
    }
    else
    {
      $(this).removeClass("select-cls");
      $("input[name='quantity["+$(this).find("span").html()+"]']").parent().remove();
      // console.log($("input[name='quantity["+$(this).find("span").html()+"]']").parent());
    }
  });

  $(document).on("click",".double-num",function(){
    if(!$(this).hasClass("select-cls")){
      var i=0;
      $( ".double_patti_box" ).each(function( index ) {
        i++
      });
      var t_bet=0;
        
      // if(parseInt(t_bet) + parseInt(i) >=100)
      // {
      //   swal("You Can Only Bet on 100 Double Patti Numbers Today");
      // }
      // else
      // {
        $(this).addClass("select-cls");
        var new_div= $("#clone-cls").clone().attr("id","").addClass("clone-class").removeAttr( "style" ).appendTo(".show-input");
        new_div.find(".b-num").html($(this).find("span").html());
        new_div.find("input").attr('name','quantity['+$(this).find("span").html()+']');
      // }
    }
    else
    {
      $(this).removeClass("select-cls");
      $("input[name='quantity["+$(this).find("span").html()+"]']").parent().remove();
      // console.log($("input[name='quantity["+$(this).find("span").html()+"]']").parent());
    }
  });
 
</script>
</body>
</html>
