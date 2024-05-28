const cpfInput = document.getElementById('cpf');

cpfInput.addEventListener('input', () => {
  const cpf = cpfInput.value.replace(/\D/g, '');
  cpfInput.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
});
