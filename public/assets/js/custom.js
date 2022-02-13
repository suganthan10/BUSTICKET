

function isTextKey(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  return (((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122)) || (charCode==8 ||charCode==9)  );
}

function isTextKeySpace(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  return ((charCode == 32 || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122)) || (charCode==8 ||charCode==9)  );
}

function isNumberKey(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

function isPhoneNumberKey(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

function isEmail(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  return ((charCode == 13 || charCode == 47 || charCode == 46 || charCode == 45 || charCode == 64 || charCode == 95 || charCode == 31 || (charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122)) || (charCode==8 ||charCode==9)  );
}

function isAddress(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  return ((charCode == 13 || charCode == 47 || charCode == 46 || charCode == 45 || charCode == 44 || charCode == 32 || charCode == 31 || (charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122)) || (charCode==8 ||charCode==9)  );
}

function isCurrency(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

function isNIC(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  return !(charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 86 && charCode != 88 && charCode != 118 && charCode != 120) );
}

function isPercentage(evt,id){

  text = $("#"+id).val();

  valfull = text+ String.fromCharCode(evt.keyCode);
  if ( isNaN(valfull )){
    return false;
  }else if(valfull > 99.99){
    return false;
  }else if((valfull.split('.')[1] || []).length > 2){
    return false;
  }

}

 $(document).ready(function () {
    $( "#traveldate" ).datepicker({
         dateFormat:'yy-mm-dd',
         minDate:0
      });
  } );

function getSeat(val){
  //alert('val '+val);
  $("#seatno").val(val);
  $('#seatModal').modal('hide');
}

$("#seatno").click(function() {

  let travel_date = $("input[name=travel_date]").val();
  let start_location = $("#startlocation").val();
  let end_location = $("#endlocation").val();
  let vehicle_no = $("#vehicleno").val();
  let appbaseurl = $("input[name=appbaseurl]").val();
  let csrftoken = $("input[name=_token]").val();

  if(travel_date==""){
      alert('Please select the travel date');
  }else if(start_location==""){
      alert('Please select the start location');
  }else if(end_location==""){
      alert('Please select the end location');
  }else if(vehicle_no==""){
      alert('Please select the vehicle');
  }else{

    $.ajax({
        url: appbaseurl+"/ajax-seatno",
        type:"POST",
        data:{
          travel_date:travel_date,
          start_location:start_location,
          end_location:end_location,
          vehicle_no:vehicle_no,
           _token: csrftoken,
        },
        success:function(response){
          //console.log(response.success);
          $('#seatinfo').html(response.success);
          if(response) {
            console.log(response);
          }
        },
        error: function(error) {
         console.log(error);
        }
    });


    $('#seatModal').modal('show');
  }

});
