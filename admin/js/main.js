function newIngredient() {
    var block = document.querySelector('.ingredientslist .ingredientsblock');
    var new_block = block.cloneNode(true);
    document.querySelector('.ingredientslist').appendChild(new_block);

    new_block.querySelector('select').value = '';
}

document
    .querySelector('.ingredient-new2')
    .addEventListener('click', function (click) {
        click.preventDefault();
        var block = document.querySelector(
            '.ingredientslist .ingredientsblock'
        );
        var new_block = block.cloneNode(true);
        document.querySelector('.ingredientslist').appendChild(new_block);

        new_block.querySelector('select').value = '';
    });
