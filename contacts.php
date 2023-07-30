<?php
session_start();
require 'config.php';
?>

<main class="border-top">
<body class="shadow-lg">
  <!-- Temmplate Elemente einbinden, div tag mit Class werden noch gebraucht für die php-file, 
  damit man die noch mit eigenem CSS Stylesheet ändern  kann.-->
  <?php
  include "webElements/header.php";
  $page = "post";
  include "webElements/nav.php";
  ?>
  <div class="container ">
    <div class="row">

      <?php include  "webElements/sidebar.php"; ?>

      <div class="col">
        <div class="row">
          <div class="col md-auto">
            <h2>Kontakte</h2>
          </div>
        </div>



        <!-- Die Tabelle von den Partneruniversitäten-->
        <div class="row px-3 table-wraper">
          <a href="inbox.php" class="btn btn-outline-primary mt-1 w-100">Zurück zum Postfach</a>
          <Form class=" m-0 p-0">

            <table class="table table-hover border border-secondary mt-1 my-table" id="my-table">
              <thead>
                <tr class=" table-info">
                  <th scope="col"><b>#</b></th>
                  <th scope="col" colspan="2"><b>Name</b></th>
                  <th scope="col" class="text-end"><b>Kontaktieren</b></th>
                </tr>
              </thead>
              <tbody>
                <!--!!!wenn keine Suchkriterien eingesetzt ist, dann normale tabelle sonst andere tabelle
          oder einfach die SQL statement ändern?  -->
                <?php include 'contactstable.php'; ?>
              </tbody>
            </table>
          </Form>
        </div>
      </div>
    </div>


  </div>

  <script>
    $(document).ready(function() {
      $(document).on('click', '.contactBtn', function() {
        var perId = $(this).attr("id");
        $.ajax({
          url: "fetchID.php",
          method: "POST",
          data: {
            PersonID: perId
          },
          dataType: "json",
          success: function(data) {
            window.location.href = "neueMsg.php?recipName=" + data.FirstName + "." + data.LastName;
          }
        });


      });
    });
  </script>

  </main>
<?php
include "webElements/footer.php";
?>
