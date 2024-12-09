<x-app-layout>
    

    <div class="container">
        <div class="mt-5">
        <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th width="240px">Action</th>
                        </tr>
                    </thead>
                    <tbody id="projects-table-body">
                         
                    </tbody>
                     
                </table>
        </div>
        
    </div>

   
        <script type="module">
            
            showAllUnidades();
            function showAllUnidades() {
                let url = $('meta[name=app-url]').attr("content") + "/welcome";
                $("#ruta").append(url);
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let u = response.unidad;
                        for (var i = 0; i < u.length; i++){
                            let unidadRow = '<tr>' +
                            '<td>'+ u[i].estado  +'</td>' +
                            '</tr>';
                            $('#projects-table-body').append(unidadRow)
                        }
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    } 
                });
            }

           


        </script>
    </div>
</x-app-layout>