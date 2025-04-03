"use strict";

// problem 1
function length(s) {
    const checkArray = s.trim().split(" ")
    const lastIndex = checkArray.length - 1
    if (checkArray[lastIndex] === '') {
        return 0
    } else {
        return checkArray[lastIndex].length
    }
}

// problem 2
function romanToInt(s) {
    const romanSymbol = new Map([
        ['I', 1],
        ['V', 5],
        ['X', 10],
        ['L', 50],
        ['C', 100],
        ['D', 500],
        ['M', 1000],
    ]);
    let result = 0;

    for (let i = 0; i < s.length; i++) {
        const current = romanSymbol.get(s[i]);
        const next = romanSymbol.get(s[i + 1]);

        if (current < next) {
            result = result + next - current;
            i++;
        } else {
            result += current;
        }
    }

    return result;
}

// problem 3
function kangaroo(x1, v1, x2, v2) {

    if (x1 > x2 && v1 > v2) {
        return "NO"
    }
    if (x1 < x2 && v1 < v2) {
        return "NO"
    }

    if (v1 == v2) {
        return "NO"
    }

    if ((x2 - x1) % (v1 - v2) == 0) {
        return "YES"
    } else {
        return "NO"
    }
}
