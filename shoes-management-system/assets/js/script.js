/* This is SMS Script File */
jQuery(function () {
  console.log("Welcome To Wordpress List Table development Tutorial");

  jQuery("#deactivate-shoes-management-system").on("click", function (event) {
    event.preventDefault();

    var hasConfirm = confirm(
      "Are you sure want to de-activate 'Shoes Management System'?"
    ); // Cancel -> false // Ok -> true

    if (hasConfirm) {
      var deactivateLink = jQuery(this).attr("href");

      window.location.href = deactivateLink;
    }
  }); // Form validation

  jQuery("#frm-add-shoe").validate(); // Handle Media Uplaod Event

  jQuery("#btn-upload-cover").on("click", function (event) {
    event.preventDefault(); // Media Object

    var mediaUploader = wp.media({
      title: "Upload Shoe Cover",
      multiple: false,
    }); // Media open

    mediaUploader.open(); // Cover image file selection

    mediaUploader.on("select", function () {
      var attachment = mediaUploader.state().get("selection").first().toJSON(); //console.log(attachment);

      jQuery("#cover_image").val(attachment.url);
    });
  });
});
