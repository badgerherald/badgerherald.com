export function approxOccurances(content, query) {
  var searchKeywords = query.toLocaleLowerCase().split(" ");
  var startingIndices = [];
  searchKeywords.map((searchKeyword) => {
    var indexOccurence = content.indexOf(searchKeyword, 0);

    while (indexOccurence >= 0) {
      startingIndices.push(indexOccurence);

      indexOccurence = content.indexOf(searchKeyword, indexOccurence + 1);
    }
  });
  return startingIndices;
}
