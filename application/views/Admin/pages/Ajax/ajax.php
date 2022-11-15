
<script type="text/javascript">

    function assignbatch(id)
    {
        
     var batch_id = $("#batch_id"+id).val();
     var url = "<?php echo base_url(); ?>admin/Student/assignbatch";

        $.ajax({
            type: "POST",
            url: url,
            data: {id:id,batch_id:batch_id},

            success: function (data) {
              setInterval(function(){
                   location.reload(); 
               }, 800);
            }
         });

    }
    
    function updateorderstatus(status,order_id)
    {
        
    
     var url = "<?php echo base_url(); ?>admin/order/updateorderstatus";

        $.ajax({
            type: "POST",
            url: url,
            data: {status:status,order_id:order_id},

            success: function (data) {
              setInterval(function(){
                   location.reload(); 
               }, 800);
            }
         });

    }
    
    function getstate(country_id)
    {
        
       
       var url = "<?php echo base_url(); ?>Welcome/getstate";

        $.ajax({
            type: "POST",
            url: url,
            data: {country_id:country_id},

            success: function (response) {
            
            var  j_data = eval(response);
            var show_info='<option value="">-Select State-</option>';
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<option value="'+j_data[i].id+'">'+j_data[i].state+'</option>';
             }
              $('#state_id').html(show_info);
            }
         });

    }
    
    function getcity(state_id)
    {
        
       var country_id = $('#country_id').val();
       var url = "<?php echo base_url(); ?>Welcome/getcity";

        $.ajax({
            type: "POST",
            url: url,
            data: {country_id:country_id,state_id:state_id},

            success: function (response) {
            
            var  j_data = eval(response);
            var show_info='<option value="">-Select City-</option>';
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<option value="'+j_data[i].id+'">'+j_data[i].city+'</option>';
             }
              $('#city_id').html(show_info);
            }
         });

    }
    
    
    function getcityblock(city_id)
    {
        
       var country_id = $('#country_id').val();
       var state_id = $('#state_id').val();
       var url = "<?php echo base_url(); ?>Welcome/getcityblock";

        $.ajax({
            type: "POST",
            url: url,
            data: {country_id:country_id,state_id:state_id,city_id:city_id},

            success: function (response) {
            
            var  j_data = eval(response);
            var show_info='<option value="">-Select City Block-</option>';
    
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<option value="'+j_data[i].id+'">'+j_data[i].block+'</option>';
             }
              $('#city_block_id').html(show_info);
            }
         });

    }
    
    function getcategory(product_type)
    {
        
       
       var url = "<?php echo base_url(); ?>Welcome/getcategory";

        $.ajax({
            type: "POST",
            url: url,
            data: {product_type:product_type},

            success: function (response) {
            
            var  j_data = eval(response);
            var show_info='<option value="">-Select Category-</option>';
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<option value="'+j_data[i].id+'">'+j_data[i].category+'</option>';
             }
              $('#category_id').html(show_info);
            }
         });

    }
    
    
    function getpincode(city_id)
    {
      
       var url = "<?php echo base_url(); ?>Welcome/getpincode";

        $.ajax({
            type: "POST",
            url: url,
            data: {city_id:city_id},

            success: function (response) {
                
                var  j_data = eval(response);
                var show_info='';
                 show_info +=''+j_data[0].pincode+'';
                if(show_info != "")
                {
                $('#input-payment-postcode').val(show_info);
                chedeliverypin();
                }
                
               // $('#payamount').val(show_info);
            }
         });

    }
    
    function getbatch(class_id)
    {
        
       
       var url = "<?php echo base_url(); ?>admin/Attendance/getbatch";

        $.ajax({
            type: "POST",
            url: url,
            data: {class_id:class_id},

            success: function (response) {
            
            var  j_data = eval(response);
            var show_info='<option value="">-Select-</option>';
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<option value="'+j_data[i].id+'">'+j_data[i].Batch+'</option>';
             }
              $('#batch_id').html(show_info);
            }
         });

    }
    
    function getstudent(batch_id)
    {
        
       var class_id = $("#class_id").val();
       var url = "<?php echo base_url(); ?>admin/Attendance/getstudent";

        $.ajax({
            type: "POST",
            url: url,
            data: {class_id:class_id,batch_id:batch_id},

            success: function (response) {
            
            var  j_data = eval(response);
            var show_info='';
            var j = 1;
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<tr><td>'+j+++'</td><td><input type="hidden" name="student_id[]" value="'+j_data[i].id+'">'+j_data[i].name+'</td><td>'+j_data[i].mobile+'</td><td><select name="Attendance[]" id="Attendance" class="form-control"><option value="Present">Present</option><option value="Absent">Absent</option></select></td></tr>';
             }
            
              $("#stable").show();
              $('#student_table').html(show_info);
              
              
              
            }
         });

    }
    
     function getstudentbyclass(course_id)
    {
        
       var class_id = $("#class_id").val();
       getfee(class_id,course_id);
       var url = "<?php echo base_url(); ?>admin/Attendance/getstudentbyclass";
        
        $.ajax({
            type: "POST",
            url: url,
            data: {course_id:course_id},

            success: function (response) {
            
            var  j_data = eval(response);
            var show_info='';
            var show_info='<option value="">-Select-</option>';
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<option value="'+j_data[i].id+'">'+j_data[i].name+'</option>';
             }
              $('#student_id').html(show_info);
               
            }
         });

    }
    
    
    function checkpayment(student_id)
    {
        
       var class_id = $("#class_id").val();
       var course_id = $("#course_id").val();
       var url = "<?php echo base_url(); ?>admin/Fee/checkpayment";

        $.ajax({
            type: "POST",
            url: url,
            data: {class_id:class_id,course_id:course_id,student_id:student_id},

            success: function (response) {
            
            var  j_data = eval(response);
           
            var show_info='';
            var j = 1;
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<div class="col-md-3"><div class="form-group"><label>Instalment No</label><input type ="text"  name="instalment_no"  readonly  id="instalment_no" value ="'+j_data[i].instalment_no+'" class="form-control"><input type ="hidden"  name="instalment_id"   id="instalment_id" value ="'+j_data[i].id+'" class="form-control"></div></div><div class="col-md-3"><div class="form-group"><label>Instalment Amount</label><input type ="text"  name="instalment_amt"   id="instalment_amt" readonly value ="'+j_data[i].amount+'" class="form-control"></div></div>';
             }
              
              $("#emipaymentdiv").hide();
              $('#instalment_table').html(show_info);
              $("#otheroption").show();
              if(show_info =="")
              {
                //$("#fee_amount").val('');  
                $("#emipaymentdiv").show();  
              }
              
              if(response == '1')
              {
               $("#emipaymentdiv").hide();
               $("#otheroption").hide();
               alert('No Dues Found');
              }
            }
            
            
         });

    }
    
    
     function getonlinepackagelist(batch_id)
    {
       
       var class_id  = $("#class_id").val();
       var url = "<?php echo base_url(); ?>Welcome/OnlineTest";

        $.ajax({
            type: "POST",
            url: url,
            data: {class_id:class_id,batch_id:batch_id},

            success: function (response) {
            location.href="<?php echo base_url(); ?>OnlineTest/"+class_id+"/"+batch_id;
            }
         });

    }
    
    
    function getMargpackagelist(batch_id)
    {
       
       var class_id  = $("#class_id").val();
       var url = "<?php echo base_url(); ?>Welcome/Margdarshak";

        $.ajax({
            type: "POST",
            url: url,
            data: {class_id:class_id,batch_id:batch_id},

            success: function (response) {
            location.href="<?php echo base_url(); ?>Margdarshak/"+class_id+"/"+batch_id;
            }
         });

    }
    
    function getDLPpackagelist(batch_id)
    {
       
       var class_id  = $("#class_id").val();
       var url = "<?php echo base_url(); ?>Welcome/DLP";

        $.ajax({
            type: "POST",
            url: url,
            data: {class_id:class_id,batch_id:batch_id},

            success: function (response) {
            location.href="<?php echo base_url(); ?>DLP/"+class_id+"/"+batch_id;
            }
         });

    }
    
     function setposition(position,id)
    {
      
       var url = "<?php echo base_url(); ?>admin/Package/setposition";

        $.ajax({
            type: "POST",
            url: url,
            data: {position:position,id:id},

            success: function (response) {
             location.reload(); 
            }
         });

    }
</script>

