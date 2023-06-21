import 'dart:convert';

import 'package:flutter/material.dart';
import '../models/article.dart';
import '../providers/api_provider.dart';
import 'article_page.dart';

class AuthorArticlesPage extends StatefulWidget {
  final Article article;

  const AuthorArticlesPage({
    required this.article,
  });

  @override
  _AuthorArticlesPageState createState() => _AuthorArticlesPageState();
}

class _AuthorArticlesPageState extends State<AuthorArticlesPage> {
  List<Article> articles = [];

  @override
  void initState() {
    super.initState();
    fetchAuteurArticles();
  }

  Future<void> fetchAuteurArticles() async {
  final response = await ApiProvider.get(widget.article.hrefAuteur);
  if (response.statusCode == 200) {
    final Map<String, dynamic> data = json.decode(response.body);
    final List<dynamic> articlesJson = data['articles'];
    setState(() {
      articles = articlesJson
          .map((json) => Article.fromJson(json))
          .toList();
    });
  } else {
    throw Exception('Failed to fetch articles');
  }
}

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Articles de ${widget.article.auteur}'),
      ),
      body: Column(
        children: [
          Expanded(
            child: ListView.builder(
              itemCount: articles.length,
              itemBuilder: (context, index) {
                final article = articles[index];
                return ListTile(
                  title: Text(article.titre),
                  subtitle: Text(
                    'Auteur: ${article.auteur} | Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}',
                  ),
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) =>
                            ArticlePage(article: article),
                      ),
                    );
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
