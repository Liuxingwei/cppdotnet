function set_lan(){
      var value=$("#lang_chose").val();
      // console.log("chose:"+value);
      switch(value){
            case '0':
                  editor.session.setMode("ace/mode/c_cpp");
                  editor.setValue(c_prime_code);
                  break;
            case '1':
                  editor.session.setMode("ace/mode/c_cpp");
                  editor.setValue(cpp_prime_code);
                  break;
            case '3':
                  editor.session.setMode("ace/mode/java");
                  editor.setValue(java_prime_code);
                  break;
            case '6':
                  editor.session.setMode("ace/mode/python");
                  editor.setValue(Python_prime_code);
                  break;
            case '7':
                  editor.session.setMode("ace/mode/php");
                  editor.setValue(PHP_prime_code);
                  break;
      }
      editor.gotoLine(1);
}
$("#lang_chose").change(function(){
      set_lan();
});