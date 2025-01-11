function convertToLatex(formula) {
    let latex = formula
        .replace(/\\frac{(.*?)\s*}{(.*?)\s*}/g, '\\frac{$1}{$2}') 
        .replace(/([0-9]*\.?[0-9]+)\s*\^\s*([0-9]*\.?[0-9]+)/g, '$1^{ $2 }')
        .replace(/([a-zA-Z]+)\s*\^/g, '$1^{ }') 
        .replace(/([a-zA-Z]+)\s*\*?\s*\(/g, '$1\\left(')
        .replace(/\)\s*\*?\s*([a-zA-Z]+)/g, '\\right) $1')
        .replace(/\s*\^\s*/g, '^') 
        .replace(/([*])/g, '\\cdot ') 
        .replace(/(\+|\-|\*|\:|\<|\>)/g, ' $1 ')
        .replace(/([0-9]*\.?[0-9]+)/g, '$1');

    return latex;
}

function displayLatex(f) {
    const formulaString = f;
    const latexFormula = convertToLatex(formulaString);
    document.getElementById('latexOutput').innerHTML = `$$ ${latexFormula} $$`;
    MathJax.typeset();
}
