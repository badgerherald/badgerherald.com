import { h } from "@stencil/core";

export function approxOccurances(content, query) {
  var searchKeywords = query.toLocaleLowerCase().split(" ");
  var startingIndices = [];
  searchKeywords.map((searchKeyword) => {
    var indexOccurence = content.toLowerCase().indexOf(searchKeyword, 0);

    while (indexOccurence >= 0) {
      startingIndices.push(indexOccurence);

      indexOccurence = content
        .toLowerCase()
        .indexOf(searchKeyword, indexOccurence + 1);
    }
  });
  return startingIndices;
}

export function annotatedOccurances(occurances, content, query, splice = true) {
  return occurances.map((occurance, index) => {
    if (index > 1) {
      return undefined;
    }
    var words;
    if (splice) {
      words = content
        .slice(occurance - 24, occurance + 60)
        .split(" ")
        .splice(1); // remove first incomplete word
    } else {
      words = content.split(" ");
    }

    return [
      words.map((word) => {
        return query
          .split(" ")
          .find((part) =>
            word.toLocaleLowerCase().includes(part.toLocaleLowerCase())
          )
          ? [wrappedWord(word, query), " "]
          : word + " ";
      }),
      splice ? "... " : "",
    ];
  });
}

function wrappedWord(word: String, query) {
  let match = query
    .split(" ")
    .find((part) =>
      word.toLocaleLowerCase().includes(part.toLocaleLowerCase())
    );
  if (!match) {
    return word;
  }
  let index = word.toLocaleLowerCase().indexOf(match.toLocaleLowerCase());
  let pre = word.substr(0, index - 1);
  let part = word.substr(index, match.length);
  let post = word.substr(index + match.length);

  return (
    <span class="match">{[pre, <span class="part">{part}</span>, post]}</span>
  );
}
