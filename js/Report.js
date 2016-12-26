  $(function() {
    $("#start_date").datepicker({
        dateFormat: 'yy-mm-dd',
    });
  });
  
  $(function() {
    $( "#end_date" ).datepicker({
        dateFormat: 'yy-mm-dd',
    });
  });
  $('#print').click(function(e){
      this.form.target='_blank';
      return true;
  });
  //table.display thead th
  $(function() {
      $("table.display thead th").css( "padding-left", "2px" );
      $("table.display thead th").css( "padding-right", "2px" );
      $("table.dataTable").css("font-size", "12px");
  });
  
  $("select#advertiser_id").change(function(){
      //alert($(this).val());
      
      $.ajax({
          type: "POST",
          url: "Report/getChildList",///astarserve/as/index.php/Report/getChildList
          data: {parent_id: $(this).val(), fk_name:'advertiser_id', table_name: 'brand'},
          datatype: "json",
          success: function(data){
            var options = '<option value=""></option>';
            $.each(data, function(){
                options += '<option value="' + this.id + '">' + this.name + '</option>';
            });
            $("select#brand_id").html(options);
            $("select#variant_id").html("");
            $("select#campaign_id").html("");
          }
      });
  });
  
  $("select#brand_id").change(function(){
      //alert($(this).val());
      
      $.ajax({
          type: "POST",
          url: "Report/getChildList",///astarserve/as/index.php/Report/getChildList
          data: {parent_id: $(this).val(), fk_name:'brand_id', table_name: 'variant'},
          datatype: "json",
          success: function(data){
            var options = '<option value=""></option>';
            $.each(data, function(){
                options += '<option value="' + this.id + '">' + this.name + '</option>';
            });
            $("select#variant_id").html(options);
            $("select#campaign_id").html("");
          }
      });
  });
  
  $("select#variant_id").change(function(){
      //alert($(this).val());
      
      $.ajax({
          type: "POST",
          url: "Report/getChildList",///astarserve/as/index.php/Report/getChildList
          data: {parent_id: $(this).val(), fk_name:'variant_id', table_name: 'campaign'},
          datatype: "json",
          success: function(data){
            var options = '<option value=""></option>';
            $.each(data, function(){
                options += '<option value="' + this.id + '">' + this.name + '</option>';
            });
            $("select#campaign_id").html(options);
          }
      });
  });