
<script type="text/javascript">

     function updateorderstatus(status,order_id)
    {
        
    
     var url = "<?php echo base_url(); ?>user/order/updateorderstatus";

        $.ajax({
            type: "POST",
            url: url,
            data: {status:status,order_id:order_id},

            success: function (data) {
              /*setInterval(function(){
                   location.reload(); 
               }, 800);*/
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
    
     function getsubcategory(category_id)
    {
       var product_type = $("#product_type").val(); 
       var user_id = <?php echo  $this->session->userdata['user_session']['user_id']?>;
       var url = "<?php echo base_url(); ?>Welcome/getsubcategory";

        $.ajax({
            type: "POST",
            url: url,
            data: {product_type:product_type,category_id:category_id,user_id:user_id},

            success: function (response) {
            
            var  j_data = eval(response);
            var show_info='<option value="">-Select Sub Category-</option>';
            for (var i = 0; i < j_data.length; i++) 
             {
                show_info +='<option value="'+j_data[i].id+'">'+j_data[i].subcategory+'</option>';
             }
              $('#subcategory_id').html(show_info);
            }
         });

    }
    
    
     function updateproduct(feture_id,pro_id)
    {
        
       var url = "<?php echo base_url(); ?>Welcome/updateproduct";

        $.ajax({
            type: "POST",
            url: url,
            data: {feture_id:feture_id,pro_id:pro_id},

            success: function (response) {
                location.reload();
            }
         });

    }
    
    
    
</script>

