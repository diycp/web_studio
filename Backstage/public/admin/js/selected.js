function getSelectedsId(data){
    var ids = new Array();
    if(data){
        for (var i = 0; i < data.length; i++) {
            ids.push(data[i].id);
        }
    }
    return ids;
}