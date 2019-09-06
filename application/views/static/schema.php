<style>
        .buttons {
            width: 20%;
            margin: 10px auto;
        }
    </style>
          <div class="schema_style" style="width:650px;margin:40px auto;font-size: 16px;font-weight: bold;border-radius: 10%">
        <div id="list">
            
        </div>
        <div class="buttons">
            
            <input type="hidden" name="schema_list" value="" id="schema_list">
            <button class="btn btn-sm btn-block btn-danger px-5 py-2 text-light" onclick="SchemaListSelected()"> Next
                
            </button>  
        </div>
    </div>

     <script type="text/javascript">
          function SchemaListSelected(){
            var selbox =  document.getElementsByClassName("dropdown_select_list");
            var schemaList = "";
            console.log(selbox[1].options);
             for (var i=0, iLen=selbox[1].options.length; i<iLen; i++) {
                if(!schemaList){
                    schemaList = selbox[1].options[i].value;
                } else {
                    schemaList = schemaList +',' + selbox[1].options[i].value;
                }
             }
                     if(schemaList == ''){
         // window.location.href = weblink + 'create-job/';
         window.alert('select Schemas');

                     } else {

                        $.ajax({
                            url: weblink + "schemas-update/",
                            type:"POST",
                            datatype:"json",
                            data: {'id': schemaList },
                            success:function(result){
                                result = JSON.parse(result);
                                if(result.status == 'success'){
                                    
                             window.location.href = weblink + 'table'  ;          
                            }
                        }
                        });
                       
                     }
    }
      </script> 
