import 'package:flutter/material.dart';

import '../models/article.dart';
import 'article_page.dart';

class ArticleSearchDelegate extends SearchDelegate<String> {
  final List<Article> articles;

  ArticleSearchDelegate(this.articles);

  @override
  String get searchFieldLabel => 'Rechercher dans les articles';

  @override
  List<Widget> buildActions(BuildContext context) {
    return [
      IconButton(
        icon: Icon(Icons.clear),
        onPressed: () {
          query = '';
        },
      ),
    ];
  }

  @override
  Widget buildLeading(BuildContext context) {
    return IconButton(
      icon: Icon(Icons.arrow_back),
      onPressed: () {
        close(context, '');
      },
    );
  }

  @override
  Widget buildResults(BuildContext context) {
    final searchResults = articles.where((article) {
      final titleMatches = article.titre
          .toLowerCase()
          .contains(query.toLowerCase());
      final summaryMatches = article.resume
          .toLowerCase()
          .contains(query.toLowerCase());
      return titleMatches || summaryMatches;
    }).toList();

    return ListView.builder(
      itemCount: searchResults.length,
      itemBuilder: (context, index) {
        final article = searchResults[index];
        return ListTile(
          title: Text(article.titre),
          subtitle: Text(
              'Auteur: ${article.auteur} | Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}'),
          onTap: () {
            close(context, article.titre);
            Navigator.push(
              context,
              MaterialPageRoute(
                builder: (context) => ArticlePage(article: article),
              ),
            );
          },
        );
      },
    );
  }

  @override
  Widget buildSuggestions(BuildContext context) {
    final suggestionList = articles.where((article) {
      final titleMatches = article.titre
          .toLowerCase()
          .contains(query.toLowerCase());
      final summaryMatches = article.resume
          .toLowerCase()
          .contains(query.toLowerCase());
      return titleMatches || summaryMatches;
    }).toList();

    return ListView.builder(
      itemCount: suggestionList.length,
      itemBuilder: (context, index) {
        final article = suggestionList[index];
        return ListTile(
          title: Text(article.titre),
          onTap: () {
            query = article.titre;
            showResults(context);
          },
        );
      },
    );
  }
}
