<?php

namespace Database\Seeders;

use App\Models\Snippet;
use Illuminate\Database\Seeder;

class SnippetSeeder extends Seeder
{
    public function run(): void
    {
        $snippets = [
            // React
            [
                'code' => "const App = () => {\n  const [count, setCount] = useState(0);\n  \n  return (\n    <div>\n      <p>Count: {count}</p>\n      <button onClick={() => setCount(count + 1)}>Increment</button>\n    </div>\n  );\n};",
                'language' => 'JavaScript',
                'framework' => 'React',
                'difficulty' => 'easy',
            ],
            
            // Vue.js
            [
                'code' => "<template>\n  <div>\n    <p>{{ message }}</p>\n    <button @click=\"reverseMessage\">Reverse</button>\n  </div>\n</template>\n\n<script>\nexport default {\n  data() {\n    return { message: 'Hello Vue!' }\n  },\n  methods: {\n    reverseMessage() {\n      this.message = this.message.split('').reverse().join('')\n    }\n  }\n}\n</script>",
                'language' => 'JavaScript',
                'framework' => 'Vue.js',
                'difficulty' => 'easy',
            ],
            
            // Laravel
            [
                'code' => "Route::get('/users', function () {\n    return User::with('posts')\n        ->where('active', true)\n        ->paginate(15);\n});\n\nRoute::post('/users', [UserController::class, 'store'])\n    ->middleware('auth');",
                'language' => 'PHP',
                'framework' => 'Laravel',
                'difficulty' => 'easy',
            ],
            
            // Django
            [
                'code' => "from django.db import models\n\nclass Article(models.Model):\n    title = models.CharField(max_length=200)\n    content = models.TextField()\n    published_date = models.DateTimeField(auto_now_add=True)\n    author = models.ForeignKey(User, on_delete=models.CASCADE)\n    \n    class Meta:\n        ordering = ['-published_date']\n    \n    def __str__(self):\n        return self.title",
                'language' => 'Python',
                'framework' => 'Django',
                'difficulty' => 'medium',
            ],
            
            // Angular
            [
                'code' => "@Component({\n  selector: 'app-user-list',\n  template: `\n    <div *ngFor=\"let user of users\">\n      <h3>{{ user.name }}</h3>\n      <p>{{ user.email }}</p>\n    </div>\n  `\n})\nexport class UserListComponent implements OnInit {\n  users: User[] = [];\n  \n  constructor(private userService: UserService) {}\n  \n  ngOnInit() {\n    this.userService.getUsers().subscribe(data => {\n      this.users = data;\n    });\n  }\n}",
                'language' => 'TypeScript',
                'framework' => 'Angular',
                'difficulty' => 'medium',
            ],
            
            // Express.js
            [
                'code' => "const express = require('express');\nconst app = express();\n\napp.use(express.json());\n\napp.get('/api/users/:id', async (req, res) => {\n  try {\n    const user = await User.findById(req.params.id);\n    if (!user) {\n      return res.status(404).json({ error: 'User not found' });\n    }\n    res.json(user);\n  } catch (error) {\n    res.status(500).json({ error: error.message });\n  }\n});\n\napp.listen(3000);",
                'language' => 'JavaScript',
                'framework' => 'Express.js',
                'difficulty' => 'easy',
            ],
            
            // Spring Boot
            [
                'code' => "@RestController\n@RequestMapping(\"/api/products\")\npublic class ProductController {\n    \n    @Autowired\n    private ProductService productService;\n    \n    @GetMapping\n    public ResponseEntity<List<Product>> getAllProducts() {\n        return ResponseEntity.ok(productService.findAll());\n    }\n    \n    @PostMapping\n    public ResponseEntity<Product> createProduct(@RequestBody Product product) {\n        Product saved = productService.save(product);\n        return ResponseEntity.status(HttpStatus.CREATED).body(saved);\n    }\n}",
                'language' => 'Java',
                'framework' => 'Spring Boot',
                'difficulty' => 'medium',
            ],
            
            // Ruby on Rails
            [
                'code' => "class ArticlesController < ApplicationController\n  before_action :authenticate_user!, except: [:index, :show]\n  \n  def index\n    @articles = Article.published.order(created_at: :desc).page(params[:page])\n  end\n  \n  def create\n    @article = current_user.articles.build(article_params)\n    \n    if @article.save\n      redirect_to @article, notice: 'Article created successfully'\n    else\n      render :new, status: :unprocessable_entity\n    end\n  end\n  \n  private\n  \n  def article_params\n    params.require(:article).permit(:title, :content)\n  end\nend",
                'language' => 'Ruby',
                'framework' => 'Ruby on Rails',
                'difficulty' => 'medium',
            ],
            
            // FastAPI
            [
                'code' => "from fastapi import FastAPI, HTTPException\nfrom pydantic import BaseModel\n\napp = FastAPI()\n\nclass Item(BaseModel):\n    name: str\n    price: float\n    description: str = None\n\n@app.post(\"/items/\")\nasync def create_item(item: Item):\n    return {\"item_id\": 1, **item.dict()}\n\n@app.get(\"/items/{item_id}\")\nasync def read_item(item_id: int):\n    if item_id not in items:\n        raise HTTPException(status_code=404, detail=\"Item not found\")\n    return items[item_id]",
                'language' => 'Python',
                'framework' => 'FastAPI',
                'difficulty' => 'medium',
            ],
            
            // Svelte
            [
                'code' => "<script>\n  let count = 0;\n  \n  function increment() {\n    count += 1;\n  }\n  \n  $: doubled = count * 2;\n</script>\n\n<main>\n  <h1>Count: {count}</h1>\n  <p>Doubled: {doubled}</p>\n  <button on:click={increment}>+1</button>\n</main>\n\n<style>\n  main {\n    text-align: center;\n    padding: 1em;\n  }\n</style>",
                'language' => 'JavaScript',
                'framework' => 'Svelte',
                'difficulty' => 'medium',
            ],
            
            // Next.js
            // [
            //     'code' => "export async function getServerSideProps(context) {\n  const res = await fetch(`https://api.example.com/data`);\n  const data = await res.json();\n  \n  return {\n    props: { data },\n  };\n}\n\nexport default function Page({ data }) {\n  return (\n    <div>\n      <h1>{data.title}</h1>\n      <p>{data.description}</p>\n    </div>\n  );\n}",
            //     'language' => 'JavaScript',
            //     'framework' => 'Next.js',
            //     'difficulty' => 'medium',
            // ],
            
            // Flask
            [
                'code' => "from flask import Flask, jsonify, request\nfrom flask_sqlalchemy import SQLAlchemy\n\napp = Flask(__name__)\napp.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///data.db'\ndb = SQLAlchemy(app)\n\n@app.route('/api/users', methods=['GET'])\ndef get_users():\n    users = User.query.all()\n    return jsonify([user.to_dict() for user in users])\n\n@app.route('/api/users', methods=['POST'])\ndef create_user():\n    data = request.get_json()\n    user = User(name=data['name'], email=data['email'])\n    db.session.add(user)\n    db.session.commit()\n    return jsonify(user.to_dict()), 201",
                'language' => 'Python',
                'framework' => 'Flask',
                'difficulty' => 'easy',
            ],
            
            // // Symfony
            // [
            //     'code' => "namespace App\\Controller;\n\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Annotation\\Route;\n\nclass ProductController extends AbstractController\n{\n    #[Route('/products', name: 'product_list')]\n    public function list(ProductRepository $repository): Response\n    {\n        $products = $repository->findBy(\n            ['available' => true],\n            ['createdAt' => 'DESC']\n        );\n        \n        return $this->render('product/list.html.twig', [\n            'products' => $products,\n        ]);\n    }\n}",
            //     'language' => 'PHP',
            //     'framework' => 'Symfony',
            //     'difficulty' => 'medium',
            // ],
            
            // NestJS
            [
                'code' => "@Controller('cats')\nexport class CatsController {\n  constructor(private catsService: CatsService) {}\n\n  @Get()\n  async findAll(): Promise<Cat[]> {\n    return this.catsService.findAll();\n  }\n\n  @Post()\n  @UsePipes(new ValidationPipe())\n  async create(@Body() createCatDto: CreateCatDto) {\n    return this.catsService.create(createCatDto);\n  }\n\n  @Get(':id')\n  findOne(@Param('id') id: string) {\n    return this.catsService.findOne(+id);\n  }\n}",
                'language' => 'TypeScript',
                'framework' => 'NestJS',
                'difficulty' => 'hard',
            ],
            
            // Livewire
            [
                'code' => "namespace App\\Livewire;\n\nuse Livewire\\Component;\n\nclass Counter extends Component\n{\n    public int \$count = 0;\n    \n    public function increment()\n    {\n        \$this->count++;\n    }\n    \n    public function decrement()\n    {\n        \$this->count--;\n    }\n    \n    public function render()\n    {\n        return view('livewire.counter');\n    }\n}",
                'language' => 'PHP',
                'framework' => 'Livewire',
                'difficulty' => 'easy',
            ],
            
            // SolidJS
            [
                'code' => "import { createSignal } from 'solid-js';\n\nfunction Counter() {\n  const [count, setCount] = createSignal(0);\n  \n  return (\n    <div>\n      <h1>Count: {count()}</h1>\n      <button onClick={() => setCount(count() + 1)}>\n        Increment\n      </button>\n    </div>\n  );\n}\n\nexport default Counter;",
                'language' => 'JavaScript',
                'framework' => 'SolidJS',
                'difficulty' => 'medium',
            ],
            
            // Remix
            [
                'code' => "import { json } from '@remix-run/node';\nimport { useLoaderData } from '@remix-run/react';\n\nexport async function loader({ params }) {\n  const post = await getPost(params.slug);\n  if (!post) {\n    throw new Response('Not Found', { status: 404 });\n  }\n  return json({ post });\n}\n\nexport default function Post() {\n  const { post } = useLoaderData();\n  return (\n    <article>\n      <h1>{post.title}</h1>\n      <div dangerouslySetInnerHTML={{ __html: post.html }} />\n    </article>\n  );\n}",
                'language' => 'JavaScript',
                'framework' => 'Remix',
                'difficulty' => 'hard',
            ],
            
            // Qwik
            [
                'code' => "import { component\$, useSignal } from '@builder.io/qwik';\n\nexport default component\$(() => {\n  const count = useSignal(0);\n\n  return (\n    <div>\n      <p>Count: {count.value}</p>\n      <button onClick\$={() => count.value++}>\n        Increment\n      </button>\n    </div>\n  );\n});",
                'language' => 'JavaScript',
                'framework' => 'Qwik',
                'difficulty' => 'hard',
            ],

            // ASP.NET Core
            [
                'code' => "[ApiController]\n[Route(\"api/[controller]\")]\npublic class UsersController : ControllerBase\n{\n    private readonly IUserService _userService;\n    \n    public UsersController(IUserService userService)\n    {\n        _userService = userService;\n    }\n    \n    [HttpGet]\n    public async Task<ActionResult<IEnumerable<User>>> GetUsers()\n    {\n        var users = await _userService.GetAllAsync();\n        return Ok(users);\n    }\n    \n    [HttpPost]\n    public async Task<ActionResult<User>> CreateUser(UserDto dto)\n    {\n        var user = await _userService.CreateAsync(dto);\n        return CreatedAtAction(nameof(GetUsers), new { id = user.Id }, user);\n    }\n}",
                'language' => 'C#',
                'framework' => 'ASP.NET Core',
                'difficulty' => 'hard',
            ],

            // Blazor
            [
                'code' => "@page \"/counter\"\n\n<h1>Counter</h1>\n\n<p>Current count: @currentCount</p>\n\n<button class=\"btn btn-primary\" @onclick=\"IncrementCount\">Click me</button>\n\n@code {\n    private int currentCount = 0;\n\n    private void IncrementCount()\n    {\n        currentCount++;\n    }\n}",
                'language' => 'C#',
                'framework' => 'Blazor',
                'difficulty' => 'medium',
            ],
        ];

        foreach ($snippets as $snippet) {
            Snippet::create($snippet);
        }
    }
}