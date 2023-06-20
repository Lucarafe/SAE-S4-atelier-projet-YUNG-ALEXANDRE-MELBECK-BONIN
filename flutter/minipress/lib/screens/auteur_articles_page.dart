import 'package:flutter/material.dart';
import '../models/article.dart';

class AuthorArticlesPage extends StatelessWidget {
  final String author;
  final List<Article> articles;

  const AuthorArticlesPage({
    required this.author,
    required this.articles,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Auteur des articles'),
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(16.0),
            child: Text(
              'Les articles par $author',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
          Expanded(
            child: ListView.builder(
              itemCount: articles.length,
              itemBuilder: (context, index) {
                final article = articles[index];
                return ListTile(
                  title: Text(article.titre),
                  subtitle: Text(
                    'Created on: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}',
                  ),
                  onTap: () {
                    // Handle article tap
                  },
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}
