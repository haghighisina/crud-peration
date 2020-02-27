
let id         = $("input[name*='stuff_id']");
id.attr("readonly", "readonly");

$(".btnedit").click(e =>{
    let textvalues  = DisplayData(e);

    let stuffname  = $("input[name*='stuff_name']")
    let stuffpub   = $("input[name*='stuff_publisher']");
    let stuffprice = $("input[name*='stuff_price']");

    id.val(textvalues[0]);
    stuffname.val(textvalues[1]);
    stuffpub.val(textvalues[2]);
    stuffprice.val(textvalues[3]);
});

function DisplayData(e) {
    let id         = 0;
    const td       = $("#tbody tr td");
    let textvalues = [];

    for(const value of td){
        if(value.dataset.id == e.target.dataset.id){
            textvalues[id++] = value.textContent;
        }
    }
    return textvalues;
}

















