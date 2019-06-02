$(document).ready(function(){

      //when search type change
      
/*    

        $("#type_chose").change(function(){
            // console.log($(this).val());
            $("#search_input").attr('name', $(this).val());
            if($(this).val()=='id'){
                  $("#search_form").attr('action', 'problem.php');
            }else{
                  $("#search_form").attr('action', '');
            }

            // console.log('name:'+$("#search_input").attr('name'));
      });
      $("#body").click(function(){
            $("#classification").css('margin-left','-150px');
      });
      $("#classification_hint").click(function(){
            // console.log('click');
            // console.log('margin:'+$("#classification").css('margin-left'));
            var clfc = $("#classification");
            if(clfc.css('margin-left')=='-150px'){
                  clfc.css('margin-left', '0px');
            }else{
                  clfc.css('margin-left', '-150px');
            }


      });
      // $("#body").mouse
      $("#classification").mouseout(function(){
            // clfc.css('margin-left', '-150px');
      });

*/
      $("#classification_content>a").mouseover(function(){
            $("#classification_content>a").removeClass("active");
            $(this).addClass("active");
            $("#classification_content>ul").each(function(){
                  $(this).hide();
            });
            $("#classification_content>ul").eq($("#classification_content>a").index(this)).show();
      });


});
