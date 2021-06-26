<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"/>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->


    <!-- <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script> -->
    
</head>
<body>
    <div class="container mt-3">
        <h3>DATA ARTIKEL</h3>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" onClick="add()">
        Tambah Data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalArtikelForm" tabindex="-1" role="dialog" aria-labelledby="modalArtikelFormTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Form Data Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="formData" method="post" enctype="multipart/form-data">
            <div class="modal-body" form>
                <input type="hidden" id="id" name="id" value="">
                <div class="form-group">
                    <label for="judul">Judul Artikel</label>
                    <input type="text" required class="form-control " class="form-control " id="judul"  name="judul"  placeholder="Judul Artikel">
                    <!-- <div class="invalid-feedback"></div> -->
                </div>
                <div class="form-group">
                    <label for="isi">Isi Artikel</label>
                    <textarea name="isi_artikel" id="isi" placeholder="Isi"></textarea>
                    <!-- <div class="invalid-feedback"></div> -->
                </div>
                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" required class="form-control" id="thumbnail" name="thumbnail" size="20">
                    <!-- <div class="invalid-feedback"></div> -->
                </div>
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" required " class="form-control" id="tag" name="tag" placeholder="Tag">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" required " class="form-control" id="kategori" name="kategori" placeholder="Kategori">
                    <!-- <div class="invalid-feedback"></div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnSave" onClick="save()">Save changes</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <div class="card">
            <div class="card-body">
            <table id="data-artikel" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Artikel</th>
                <th>Isi Artikel</th>
                <th>Thumbnail </th>
                <th>Tag</th>
                <th>Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
            </div>
        </div>
    </div>

    <!-- javacript -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"> </script>

    <script src="https://cdn.tiny.cloud/1/evttxjjzzwiqmw5m2zxodbfq3rw9dtq7nqjmfxyszdv1ttj3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
    
    <!-- <script src="http://code.jquery.com/jquery.min.js"></script> -->
    <!-- <script src="jQuery.tagify.js"></script>
    <script src="tagify.js"></script> -->
    <script>

        var saveData;
        var modal = $('#modalArtikelForm');
        var dataTable = $('#data-artikel');
        var formData = $('#formData');
        var title = $('#modalTitle');
        var btnSave = $('#btnSave');

        $(document).ready(function() {
            dataTable.DataTable({
                "processing" : true,
                "serverSide" : true,
                "order"      : [],
                "ajax"       :{
                    "url": "<?= base_url('admin/getData')?>",
                    "type": "POST"

                },
                "columnDefs" : [{
                    "target" : [-1],
                    "orderable": false
                }]
            });
        } );

        function reloadTable(){
            dataTable.DataTable().ajax.reload();
        }
        function add(){
            saveData = 'tambah';
            formData[0].reset();
            modal.modal('show');
            title.text('Form Artikel');
        }
        function save(){
            btnSave.text('Loading....');
            btnSave.attr('disabled',true);
            if(saveData == 'tambah'){
                url = "<?= base_url('admin/add');?>"
            }else{
                url = "<?= base_url('admin/update');?>"
            }
            $.ajax({
                type: "POST",
                url: url,
                data: formData.serialize(),
                dataType: "JSON",
                success: function(response){
                    if(response.status == 'success'){
                        modal.modal('hide');
                        reloadTable();
                    }
                },

                error: function(){
                    console.log('Error Database');
                }

            });
           
        }
        function byid(id, type){
            if(type == 'edit'){
                saveData = 'edit';
                formData[0].reset();
            }

            $.ajax({
                type: "GET",
                url: "<?= base_url('admin/byid/')?>" + id,
                dataType: "JSON",
                success: function(response){
                        if(type == 'edit'){
                        title.text('Ubah Data Artikel');
                        btnSave.text('Ubah Data');
                        btnSave.attr('disabled', false);
                        $('[name="id"]').val(response.id);
                        $('[name="judul"]').val(response.judul_artikel);
                        $('[name="isi"]').val(response.isi_artikel);
                        $('[name="thumbnail"]').val(response.thumbnail_artikel);
                        $('[name="tag"]').val(response.tag_artikel);
                        $('[name="kategori"]').val(response.kategori_artikel);
                        modal.modal('show');
                    }else{
                        var result = confirm('Hapus data ' + response.judul_artikel);
                        if(result){
                            deleteData(response.id);
                        }
                    }
                },
            });
        }

        function deleteData(id){
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/delete/')?>" + id,
                dataType: "JSON",
                success: function(response){
                    reloadTable();
                },

            });
        }

        // CKEDITOR.replace( 'isi' );

        // FITUR WYSIWYG
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });


        // tagging
		// var input = document.querySelector('input[name=tag]'),
	    // // init Tagify script on the above inputs
	    // tagify = new Tagify(input, {
	    //     whitelist : ["A# .NET", "A# (Axiom)", "A-0 System", "A+", "A++", "ABAP", "ABC", "ABC ALGOL", "ABSET", "ABSYS", "ACC", "Accent", "Ace DASL", "ACL2", "Avicsoft", "ACT-III", "Action!", "ActionScript", "Ada", "Adenine", "Agda", "Agilent VEE", "Agora", "AIMMS", "Alef", "ALF", "ALGOL 58", "ALGOL 60", "ALGOL 68", "ALGOL W", "Alice", "Alma-0", "AmbientTalk", "Amiga E", "AMOS", "AMPL", "Apex (Salesforce.com)", "APL", "AppleScript", "Arc", "ARexx", "Argus", "AspectJ", "Assembly language", "ATS", "Ateji PX", "AutoHotkey", "Autocoder", "AutoIt", "AutoLISP / Visual LISP", "Averest", "AWK", "Axum", "Active Server Pages", "ASP.NET", "B", "Babbage", "Bash", "BASIC", "bc", "BCPL", "BeanShell", "Batch (Windows/Dos)", "Bertrand", "BETA", "Bigwig", "Bistro", "BitC", "BLISS", "Blockly", "BlooP", "Blue", "Boo", "Boomerang", "Bourne shell (including bash and ksh)", "BREW", "BPEL", "B", "C--", "C++ â€“ ISO/IEC 14882", "C# â€“ ISO/IEC 23270", "C/AL", "CachÃ© ObjectScript", "C Shell", "Caml", "Cayenne", "CDuce", "Cecil", "Cesil", "CÃ©u", "Ceylon", "CFEngine", "CFML", "Cg", "Ch", "Chapel", "Charity", "Charm", "Chef", "CHILL", "CHIP-8", "chomski", "ChucK", "CICS", "Cilk", "Citrine (programming language)", "CL (IBM)", "Claire", "Clarion", "Clean", "Clipper", "CLIPS", "CLIST", "Clojure", "CLU", "CMS-2", "COBOL â€“ ISO/IEC 1989", "CobolScript â€“ COBOL Scripting language", "Cobra", "CODE", "CoffeeScript", "ColdFusion", "COMAL", "Combined Programming Language (CPL)", "COMIT", "Common Intermediate Language (CIL)", "Common Lisp (also known as CL)", "COMPASS", "Component Pascal", "Constraint Handling Rules (CHR)", "COMTRAN", "Converge", "Cool", "Coq", "Coral 66", "Corn", "CorVision", "COWSEL", "CPL", "CPL", "Cryptol", "csh", "Csound", "CSP", "CUDA", "Curl", "Curry", "Cybil", "Cyclone", "Cython", "M2001", "M4", "M#", "Machine code", "MAD (Michigan Algorithm Decoder)", "MAD/I", "Magik", "Magma", "make", "Maple", "MAPPER now part of BIS", "MARK-IV now VISION:BUILDER", "Mary", "MASM Microsoft Assembly x86", "MATH-MATIC", "Mathematica", "MATLAB", "Maxima (see also Macsyma)", "Max (Max Msp â€“ Graphical Programming Environment)", "Maya (MEL)", "MDL", "Mercury", "Mesa", "Metafont", "Microcode", "MicroScript", "MIIS", "Milk (programming language)", "MIMIC", "Mirah", "Miranda", "MIVA Script", "ML", "Model 204", "Modelica", "Modula", "Modula-2", "Modula-3", "Mohol", "MOO", "Mortran", "Mouse", "MPD", "Mathcad", "MSIL â€“ deprecated name for CIL", "MSL", "MUMPS", "Mystic Programming L"]
	    // });

    </script>

</body>
</html>