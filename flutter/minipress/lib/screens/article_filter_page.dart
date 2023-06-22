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
        return Card(
          elevation: 2,
          margin: EdgeInsets.symmetric(vertical: 8, horizontal: 16),
          child: ListTile(
            title: Text(
              article.titre,
              style: TextStyle(
                fontWeight: FontWeight.bold,
              ),
            ),
            subtitle: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                SizedBox(height: 4),
                Text(
                  'Auteur: ${article.auteur}',
                  style: TextStyle(
                    color: Colors.grey[800],
                  ),
                ),
                SizedBox(height: 2),
                Text(
                  'Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}',
                  style: TextStyle(
                    color: Colors.grey[800],
                  ),
                ),
                SizedBox(height: 4),
              ],
            ),
            onTap: () {
              close(context, article.titre);
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => ArticlePage(article: article),
                ),
              );
            },
          ),
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
