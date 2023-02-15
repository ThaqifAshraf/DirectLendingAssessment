function retrieveData() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'php/retrieve.php');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Parse the JSON response
      var data = JSON.parse(xhr.responseText);

      // Build a table to display the results
      var table = document.createElement('table');
      var thead = document.createElement('thead');
      var tbody = document.createElement('tbody');

      // Create header row for the table
      var headerRow = document.createElement('tr');
      var nameHeader = document.createElement('th');
      var dobHeader = document.createElement('th');
      var postcodeHeader = document.createElement('th');
      var stateHeader = document.createElement('th');
      nameHeader.textContent = 'Name';
      dobHeader.textContent = 'DOB';
      postcodeHeader.textContent = 'Postcode';
      stateHeader.textContent = 'State';
      headerRow.appendChild(nameHeader);
      headerRow.appendChild(dobHeader);
      headerRow.appendChild(postcodeHeader);
      headerRow.appendChild(stateHeader);
      thead.appendChild(headerRow);
      table.appendChild(thead);

      // Loop through the data and create a row for each record
      data.forEach(function(record) {
        var row = document.createElement('tr');
        var nameCell = document.createElement('td');
        var dobCell = document.createElement('td');
        var postcodeCell = document.createElement('td');
        var stateCell = document.createElement('td');
        nameCell.textContent = record.name;
        dobCell.textContent = record.dob;
        postcodeCell.textContent = record.postcode;
        stateCell.textContent = record.state;
        row.appendChild(nameCell);
        row.appendChild(dobCell);
        row.appendChild(postcodeCell);
        row.appendChild(stateCell);
        tbody.appendChild(row);
      });

      table.appendChild(tbody);
      document.body.appendChild(table);
    }
  };
  xhr.send();
}
