const RequestPOST = (url, data) => {
  return Promise.resolve(
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {},
      error: function (err) {},
    })
  );
};
