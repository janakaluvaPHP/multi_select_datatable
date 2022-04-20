<?php 
//index.php
include('db_config.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title></title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script
    type="text/javascript"
    src="/js/lib/dummy.js"
    
  ></script>

    <link rel="stylesheet" type="text/css" href="/css/result-light.css">

      <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

  <style id="compiled-css" type="text/css">
      /* Styles for the drop-down. Feel free to change the styles to suit your website. :-) */

.cb-dropdown-wrap {
  max-height: 80px; /* At most, around 3/4 visible items. */
  position: relative;
  height: 19px;
}

.cb-dropdown,
.cb-dropdown li {
  margin: 0;
  padding: 0;
  list-style: none;
}

.cb-dropdown {
  position: absolute;
  z-index: 1;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background: #fff;
  border: 1px solid #888;
}

/* For selected filter. */
.active .cb-dropdown {
  background: pink;
}

.cb-dropdown-wrap:hover .cb-dropdown {
  height: 80px;
  overflow: auto;
  transition: 0.2s height ease-in-out;
}

/* For selected items. */
.cb-dropdown li.active {
  background: #ff0;
}

.cb-dropdown li label {
  display: block;
  position: relative;
  cursor: pointer;
  line-height: 19px; /* Match height of .cb-dropdown-wrap */
}

.cb-dropdown li label > input {
  position: absolute;
  right: 0;
  top: 0;
  width: 16px;
}

.cb-dropdown li label > span {
  display: block;
  margin-left: 3px;
  margin-right: 20px; /* At least, width of the checkbox. */
  font-family: sans-serif;
  font-size: 0.8em;
  font-weight: normal;
  text-align: left;
}

/* This fixes the vertical aligning of the sorting icon. */
table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc,
table.dataTable thead .sorting_asc_disabled,
table.dataTable thead .sorting_desc_disabled {
  background-position: 100% 10px;
}
    /* EOS */
  </style>

  <script id="insert"></script>


</head>
<body>
<hr/>
<!-- <p style="text-align: center">
  Employee Details <a href="https://stackoverflow.com/users/9217760/sally-cj">Sally</a>, for <a href="https://stackoverflow.com/q/49846701/9217760">this Stack Overflow question</a>. <small><a href="https://jsfiddle.net/jvretamero/bv6g0r64/">See the original Fiddle</a>.</small>
</p> -->
<h2 style="text-align: center"> Employee Details </h2>

<hr/>

<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th>First Name</th>
                <th>Last Name</th>
                <th>Hire Date</th>
                <th>Salary</th>
                <th>Manager</th>
            </tr>
        </thead>
        <!-- <tfoot>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Hire Date</th>
                <th>Salary</th>
                <th>Manager</th>
            </tr>
        </tfoot> -->
        <tbody>
        <?php

        $query = "SELECT * FROM employees ORDER BY 2 DESC";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
        ?>
        <tr>
          <td> <?php echo $row['first_name']; ?> </td> 
          <td> <?php echo $row['last_name']; ?> </td> 
          <td> <?php echo $row['hire_date']; ?> </td> 
          <td> <?php echo $row['salary']; ?> </td> 
          <td> <?php echo $row['manager_id']; ?> </td> 
        </tr>
        <?php
        }

        ?>
        <tbody>

        </tbody>
    </table>

    <script type="text/javascript">//<![CDATA[


// This code has been beautified via http://jsbeautifier.org/ with 2 spaces indentation.
$(document).ready(function() {
  function cbDropdown(column) {
    return $('<ul>', {
      'class': 'cb-dropdown'
    }).appendTo($('<div>', {
      'class': 'cb-dropdown-wrap'
    }).appendTo(column));
  }

  $('#example').DataTable({
    initComplete: function() {
      this.api().columns().every(function() {
        var column = this;
        var ddmenu = cbDropdown($(column.header()))
          .on('change', ':checkbox', function() {
            var active;
            var vals = $(':checked', ddmenu).map(function(index, element) {
              active = true;
              return $.fn.dataTable.util.escapeRegex($(element).val());
            }).toArray().join('|');

            column
              .search(vals.length > 0 ? '^(' + vals + ')$' : '', true, false)
              .draw();

            // Highlight the current item if selected.
            if (this.checked) {
              $(this).closest('li').addClass('active');
            } else {
              $(this).closest('li').removeClass('active');
            }

            // Highlight the current filter if selected.
            var active2 = ddmenu.parent().is('.active');
            if (active && !active2) {
              ddmenu.parent().addClass('active');
            } else if (!active && active2) {
              ddmenu.parent().removeClass('active');
            }
          });

        column.data().unique().sort().each(function(d, j) {
          var // wrapped
            $label = $('<label>'),
            $text = $('<span>', {
              text: d
            }),
            $cb = $('<input>', {
              type: 'checkbox',
              value: d
            });

          $text.appendTo($label);
          $cb.appendTo($label);

          ddmenu.append($('<li>').append($label));
        });
      });
    }
  });
});


  //]]></script>

  <script>
    // tell the embed parent frame the height of the content
    if (window.parent && window.parent.parent){
      window.parent.parent.postMessage(["resultsFrame", {
        height: document.body.getBoundingClientRect().height,
        slug: "41vgefnf"
      }], "*")
    }

    // always overwrite window.name, in case users try to set it manually
    window.name = "result"
  </script>


</body>
</html>
