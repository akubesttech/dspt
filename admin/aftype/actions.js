// Add Record
function addRecord() {
    // get values
    var f_pro = $("#f_pro").val();
    var fee = $("#fee").val();
    var amt_f = $("#amt_f").val();
      var amt_c = $("#amt_c").val();
        var session = $("#session").val();
          var moe = $("#moe").val();
            var Sstart = $("#Sstart").val();
              var Send = $("#Send").val();

    // Add record
    $.post("aftype/addft.php", {
        f_pro: f_pro,
        fee: fee,
        amt_f: amt_f,
        amt_c: amt_c,
        session: session,
        moe: moe,
        Sstart: Sstart,
        Send: Send
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#f_pro").val("");
     $("#fee").val("");
    $("#amt_f").val("");
     $("#amt_c").val("");
        $("#session").val("");
          $("#moe").val("");
             $("#Sstart").val("");
               $("#Send").val("");
    });
}

// READ records
function readRecords() {
    $.get("aftype/loadt.php", {}, function (data, status) {
        $(".x_content2").html(data);
    });
}


function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete User?");
    if (conf == true) {
        $.post("ajax/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}

function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_first_name").val(user.first_name);
            $("#update_last_name").val(user.last_name);
            $("#update_email").val(user.email);
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    var last_name = $("#update_last_name").val();
    var email = $("#update_email").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            first_name: first_name,
            last_name: last_name,
            email: email
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});