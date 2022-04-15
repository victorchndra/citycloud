// Source : https://www.youtube.com/watch?v=FShnKqPXknI
const rangeInput = document.querySelectorAll(".range-input input");
const birthInput = document.querySelectorAll(".birth-input input");
const progress = document.querySelector(".slider .progress");

let selisih = 1;

birthInput.forEach(input => {
    input.addEventListener("input", e =>{
        let minVal = parseInt(birthInput[0].value),
        maxVal = parseInt(birthInput[1].value);

        if((maxVal - minVal >= selisih) && maxVal <= rangeInput[1].max) {
            if(e.target.className === "input-min") {
                rangeInput[0].value = minVal;
                progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
            } else {
                rangeInput[1].value = maxVal;
                progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
            }
        }
    })
});

rangeInput.forEach(input => {
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);

        if(maxVal - minVal < selisih) {
            if(e.target.className === "range-min") {
                rangeInput[0].value = maxVal - selisih;
            } else {
                rangeInput[1].value = minVal + selisih;
            }
        } else {
            birthInput[0].value = minVal;
            birthInput[1].value = maxVal;
            progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
            progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    })
});
