function deleteItem(base_url, table, id){
    var checkstr =  confirm('Bạn có chắc chắn muốn xóa truyện này?');
    if(checkstr == true){
        $.ajax({
            type: "POST",
            url: base_url + "del-item/" + table + "/" + id,
            data: {
                tableName: table,
                itemID: id
            },
            dataType:"json",
            success:function(data)
            {
                if(data['STATUS'] == 'OK'){
                    swal({
                        title: data['MESSAGE'],
                        text: "",
                        type: "success"
                    },
                    function () {
                        window.location.reload();
                    });
                }
                else {
                    swal("Error!!!", data['MESSAGE'], "error");
                }
            }
        });
    } else {
        return false;
    }
}