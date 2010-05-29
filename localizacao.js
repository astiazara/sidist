function atualizarEstados()
{
    document.getElementById("img_ajax_estado").style.visibility="visible";
    limparSelect(document.getElementById('select_estado'));
    limparSelect(document.getElementById('select_cidade'));
    var selectPais = document.getElementById('select_pais');
    var idPais = selectPais.options[selectPais.selectedIndex].value;
    new Ajax.Updater('div_estado', 'buscarestados.php?idpais=' + idPais);
}

function atualizarCidades()
{
    document.getElementById("img_ajax_cidade").style.visibility="visible";
    limparSelect(document.getElementById('select_cidade'));
    var selectPais = document.getElementById('select_estado');
    var idEstado = selectPais.options[selectPais.selectedIndex].value;
    new Ajax.Updater('div_cidade', 'buscarcidades.php?idestado=' + idEstado);
}

function limparSelect(select)
{
    while(select.options.length > 0)
        select.remove(0);
    var item = document.createElement('option');
    item.text = '(no selected)';
    item.value = 0;
    try
    {
        select.add(item, null); // standards compliant
    }
    catch(ex)
    {
        select.add(item); // IE only
    }
}
