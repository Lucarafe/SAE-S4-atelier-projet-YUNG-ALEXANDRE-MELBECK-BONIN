import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/article.dart';
import '../models/categorie.dart';
import '../providers/api_provider.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<Article> articles = [];
  List<Categorie> categories = [];

  @override
  void initState() {
    super.initState();
    fetchData();
  }

  void fetchData() async {
    await fetchArticles();
    await fetchCategories();
  }

  Future<void> fetchArticles() async {
    final response = await ApiProvider.get('/api/articles?sort=date-desc');

    if (response.statusCode == 200) {
      final List<dynamic> articlesJson = json.decode(response.body);

      setState(() {
        articles = articlesJson.map((json) => Article.fromJson(json)).toList();
      });
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  Future<void> fetchCategories() async {
    final response = await ApiProvider.get('/api/categories');

    if (response.statusCode == 200) {
      final List<dynamic> categoriesJson = json.decode(response.body);

      setState(() {
        categories =
            categoriesJson.map((json) => Categorie.fromJson(json)).toList();
      });
    } else {
      throw Exception('Failed to fetch categories');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('MiniPress'),
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
                  subtitle: Text('Author: ${article.auteur}'),
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => ArticlePage(article: article),
                      ),
                    );
                  },
                );
              },
            ),
          ),
          Container(
            height: 200,
            child: ListView.builder(
              scrollDirection: Axis.horizontal,
              itemCount: categories.length,
              itemBuilder: (context, index) {
                final categorie = categories[index];

                return Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Chip(
                    label: Text(categorie.titre),
                    onDeleted: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) =>
                              CategoriePage(categorie: categorie),
                        ),
                      );
                    },
                  ),
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}

class ArticlePage extends StatelessWidget {
  final Article article;

  ArticlePage({required this.article});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(article.titre),
      ),
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Author: ${article.auteur}'),
            SizedBox(height: 16),
            Text('Created at: ${article.createdAt.toString()}'),
            SizedBox(height: 16),
            // Add the article content here
          ],
        ),
      ),
    );
  }
}

class CategoriePage extends StatelessWidget {
  final Categorie categorie;

  const CategoriePage({super.key, required this.categorie});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(categorie.titre),
      ),
      body: Container(
        child: Center(
          child: Text('Liste des articles par la catégorie : ${categorie.titre}'),
        ),
      ),
    );
  }
}
