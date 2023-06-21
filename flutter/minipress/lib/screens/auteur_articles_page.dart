import 'dart:convert';

import 'package:flutter/material.dart';
import '../models/article.dart';
import '../providers/api_provider.dart';

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
    fetchAuthorArticles();
  }

  void fetchAuthorArticles() async {
    final response = await ApiProvider.get(widget.article.hrefAuteur);

    if (response.statusCode == 200) {
      final List<dynamic> responseData = json.decode(response.body);
      final List<Article> fetchedArticles = responseData.map((data) {
        final String id = data['id'].toString();
        final String titre = data['titre'].toString();
        final String resume = data['resume'].toString();
        final String contenu = data['contenu'].toString();
        final String auteur = data['auteur'].toString();
        final DateTime createdAt = DateTime.parse(data['created_at']);
        return Article(
          id: id,
          titre: titre,
          resume: resume,
          contenu: contenu,
          auteur: auteur,
          createdAt: createdAt,
          href: widget.article.href,
          hrefAuteur: widget.article.hrefAuteur,
        );
      }).toList();

      setState(() {
        articles = fetchedArticles;
      });
    } else {
      throw Exception('Failed to fetch author articles');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Articles by ${widget.article.auteur}'),
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
                    'Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}',
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
