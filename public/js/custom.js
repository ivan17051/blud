$.extend( true, $.fn.dataTable.defaults, {
    "language": {
        "emptyTable":     "Tidak ada data.",
        "info":           "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        "infoEmpty":      "",
        "infoFiltered":   "(filter dari _MAX_ total data)",
        "thousands":      ".",
        "lengthMenu":     "Menampilkan _MENU_ data",
        "loadingRecords": "Memuat...",
        "processing":     "Memproses...",
        "search":         "Cari:",
        "zeroRecords":    "Tidak ada yang cocok.",
        "paginate": {
            "first":      "Awal",
            "last":       "Akhir",
            "next":       "Lanjut",
            "previous":   "Balik"
        },
        "aria": {
            "sortAscending":  ": activate to sort column ascending",
            "sortDescending": ": activate to sort column descending"
        }
    }
} );

const my={
    "request":{
        get: function(url){
            return $.ajax({
                url: url,
                type: 'GET',
            });
        },
        post: function(url, data){
            data["_token"] = "{{ csrf_token() }}"
            return $.ajax({
                url: url,
                method: 'POST',
                data: data,
            });
        },
        delete: function(url){
            const data = {"_token" : "{{ csrf_token() }}"}
            return $.ajax({
                url: url,
                method: 'DELETE',
                data: data,
            });
        },
        put: function(url, data){
            data["_token"] = "{{ csrf_token() }}"
            return $.ajax({
                url: url,
                method: 'PUT',
                data: data,
            });
        },
        upload: function(url, formdata){
            console.log(url)
            // return
            return $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                    
                        }
                    });
                    return xhr;
                },
                url: url,
                method: 'POST',
                data: formdata,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
            });
        },
    },
    'getFormData':function($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            var key =n['name'];
            var is_arr=false;
            if(/(\[\d+\])$/.test(key)){
                key = key.replace( /(\[\d+\])$/, "");
                is_arr=true;
            }else if(/(\[\])$/.test(key)){
                key = key.replace( /(\[\])$/, "");
                is_arr=true;
            }

            if(is_arr && !(key in indexed_array)) indexed_array[key] = [];            
            if(typeof n['value'] === 'string') n['value']=n['value'].trim()

            if(is_arr){
                indexed_array[key].push( n['value']);
            }else{
                if(n['value'].length || !(key in indexed_array)){
                    indexed_array[key] = n['value'];
                }
            }
            
        });

        return indexed_array;
    }
}