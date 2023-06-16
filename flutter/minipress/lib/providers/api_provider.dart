import 'package:http/http.dart' as http;

class ApiProvider {
  static const baseUrl = 'http://localhost:8083';

  static Future<http.Response> get(String endpoint) async {
    final url = Uri.parse('$baseUrl$endpoint');
    return await http.get(url);
  }
}
