document.querySelectorAll('.ajouter').forEach(button => {
    button.addEventListener('click', function() {
        const productName = this.closest('.produit').querySelector('h3').textContent;
        fetch('update_stock.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ product: productName, action: 'add' })
        })
        .then(response => response.json())
        .then(data => {
            alert('Stock updated. New quantity: ' + data.newQuantity);
        })
        .catch(error => console.error('Error:', error));
    });
});
