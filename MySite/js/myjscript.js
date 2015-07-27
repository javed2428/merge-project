var next_page_link_handle = document.getElementById('next_page_link');
//var allInputBoxes = filtered_form_handle.getElementsByTagName('input');
var cur_page_input_handle = document.getElementById('cur_page');
var filtered_form_handle = document.getElementById('filtered_form');
var next_page_clicked = 0;

if(next_page_link_handle == null){
    cur_page_input_handle.setAttribute('value', '0');
}else {

    function onNextPageClick() {
        next_page_clicked = 1;
        filtered_form_handle.submit();
        console.log("NextPageLinkClicked");
    }

    next_page_link_handle.addEventListener('click', onNextPageClick, false);


    function onFormSubmit() {
        if (next_page_clicked == 0) {
            cur_page_input_handle.setAttribute('value', '0');
            console.log("InputFieldClicked");
        }


        //next_page_clicked = 0;
    }

    filtered_form_handle.addEventListener('submit', onFormSubmit, false);
}