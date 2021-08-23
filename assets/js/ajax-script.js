// <=====================================================================================>
                // to add into database like as cart  
// <=====================================================================================>
// this function accept parameter
// url=>'accept url page of database statment'
// id => accept id of data will insert to database 
function ajax_add(url,id){
        $.ajax({
        method:"POST",
        url: url,
        cache:false,
        data:{'del_id':id},
        success: function(data){
            if(data===false){
                alert('.eror');
            }else{
                $('.msg').show("slow");
                $('.msg').delay(1000).hide("slow");
                
            }

}});
};
// <=====================================================================================>
        // insert New data to databas 
//<=====================================================================================>
// this function accept parameter
// url=>'accept url page of database statment'
// id => accept id form of data will insert to database 
function ajax_insert(url,id){
    $(document).on('click',id,function(e){    
        
            e.preventDefault();
           
            $.ajax({
            method:"POST",
            url: url,
            cache:false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success:function(){  
              
                            $('#msg').show("slow");
                            $('#msg').delay(1000).hide("slow");  
                            setInterval('location.reload()',2000); 
               
                  
        }});
        });
        

}
// <=====================================================================================>
        // face شغال 
//<=====================================================================================>
// function ajax_add(url,id){
//     $(document).on('click',id,function(e){
//             e.preventDefault();
           
//             $.ajax({
//             method:"POST",
//             url: url,
//             cache:false,
//             data:$(this).serialize(),
//             success: function(data){
//             $('#msg').html(data);
//             $(id).find('input').val('');
        
           
//         }});
//         });

// <=====================================================================================>
        // to delete  from dataBase 
//<=====================================================================================>
// this function accept parameter
// url   =>'accept url page of database statment to delete data'
// id    => accept id of data will delete from database 
//parent =>accept the id of element parent  
    function ajax_del(url,id){
        
        if(confirm('Are you sure ?')){
            $.ajax({
            method:"POST",
            url: url,
            cache:false,
            data:{'del_id':id},
            success: function(data){
                if(data===false){
                    alert("can't delete the row")
                }else{
                    $('#delete'+id).hide("slow");
                    setInterval('location.reload()',200);
                }
                
    
    }});
    }};
    // <=======================================================================>
           // function disableScroll to stop page scroll to up  
    //<===========================================================================>
    function disableScroll() { 
        // Get the current page scroll position 
        scrollTop = window.pageYOffset || document.documentElement.scrollTop; 
        scrollLeft = window.pageXOffset || document.documentElement.scrollLeft, 
      
            // if any scroll is attempted, set this to the previous value 
            window.onscroll = function() { 
            window.scrollTo(scrollLeft, scrollTop); 
            }; 
    } 
    // =============================================================================
          // function reset to reset form data .. accept oarameter 
          //id => th id of form 
     function ajax_reset(id){ $(id)[0].reset(); }

// ====================================================================
function ajax_fetch(){
    $(document).ready(function(){
		
		$.ajax({
			url: 'example.php?do=offer',
			success: function(data){
				
				// $("#customer-data").html(data);
			}
		})
	});
}
