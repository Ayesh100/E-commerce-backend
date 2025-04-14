let fieldCounter = 1;
let labelCounter = 13;
document.getElementById('addFieldBtn').addEventListener('click', function() {
    const container = document.getElementById('addInputField');

    const newDiv = document.createElement('div');
    newDiv.className = 'mb-3';

    const label = document.createElement('label');
    label.setAttribute('for', 'field_' + labelCounter);
    label.className = 'form-label';
    label.textContent = 'Field ' + labelCounter + ':';

    const input = document.createElement('input');
    input.type = 'text';
    input.value = '';
    input.className = 'form-control';
    input.name = 'field_' + fieldCounter;
    input.id = 'field_' + fieldCounter;
    input.placeholder = 'Enter spare part ID';

    const errorMessage = document.createElement('span');
    errorMessage.className = 'text-danger';

    newDiv.appendChild(label);
    newDiv.appendChild(input);
    newDiv.appendChild(errorMessage);

    container.appendChild(newDiv);

    fieldCounter++;
    labelCounter++;
});