<?php
namespace App\Services;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductManager
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function addProduct($data): Array
    {
        //Name validation
        $name = $this->stringValidation($data->name);
        if($name == 'error1')
        {
            return [
                'status' => 'false',
                'message' => 'incorrect name'
            ];
        }
        if ($name == 'error2')
        {
            return [
                'status' => 'false',
                'message' => 'name is too long'
            ];
        }
        //Category validation
        $category = $this->stringValidation($data->category);
        if($category == 'error1')
        {
            return [
                'status' => 'false',
                'message' => 'incorrect category'
            ];
        }
        if($category == 'error2')
        {
            return [
                'status' => 'false',
                'message' => 'category is too long'
            ];
        }

        //Price validation
        $price = $data->price;
        if(is_float($price) || is_int($price))
        {
            $price = floatval($data->price);
        }
        if($price == '')
        {
            return [
                'status' => 'false',
                'message' => 'incorrect price'
            ];
        }

        $product = new Product;
        $product->setName($name);
        $product->setCategory($category);
        $product->setPrice($price);

        $this->em->persist($product);
        $this->em->flush();

        return [
            'status' => 'ok',
            'message' => 'product with id='.$product->getId().' created.'
        ];
    }

    public function updateProduct($id, $data): Array
    {
        //Name validation
        if(!empty($data->name))
        {
            $name = $this->stringValidation($data->name);
            if($name == 'error1')
            {
                return [
                    'status' => 'false',
                    'message' => 'incorrect name'
                ];
            }
            if ($name == 'error2')
            {
                return [
                    'status' => 'false',
                    'message' => 'name is too long'
                ];
            }
        }
        //Category validation
        if(!empty($data->category))
        {
            $category = $this->stringValidation($data->category);
            if($category == 'error1')
            {
                return [
                    'status' => 'false',
                    'message' => 'incorrect category'
                ];
            }
            if($category == 'error2')
            {
                return [
                    'status' => 'false',
                    'message' => 'category is too long'
                ];
            }
        }

        //Price validation
        if(!empty($data->price))
        {
            $price = $data->price;
            if(is_float($price) || is_int($price))
            {
                $price = floatval($data->price);
            }
            if($price == '')
            {
                return [
                    'status' => 'false',
                    'message' => 'incorrect price'
                ];
            }
        }

        $product = $this->em->getRepository(Product::class)->find($id);
        if($product)
        {
            //Name validation
            if(!empty($data->name))
            {
                $name = $this->stringValidation($data->name);
                if($name == 'error1')
                {
                    return [
                        'status' => 'false',
                        'message' => 'incorrect name'
                    ];
                }
                if ($name == 'error2')
                {
                    return [
                        'status' => 'false',
                        'message' => 'name is too long'
                    ];
                }
                $product->setName($name);
            }
            
            //Category validation
            if(!empty($data->category))
            {
                $category = $this->stringValidation($data->category);
                if($category == 'error1')
                {
                    return [
                        'status' => 'false',
                        'message' => 'incorrect category'
                    ];
                }
                if($category == 'error2')
                {
                    return [
                        'status' => 'false',
                        'message' => 'category is too long'
                    ];
                }
                $product->setCategory($category);
            }

            //Price validation
            if(!empty($data->price))
            {
                $price = $data->price;
                if(is_float($price) || is_int($price))
                {
                    $price = floatval($data->price);
                }
                if($price == '')
                {
                    return [
                        'status' => 'false',
                        'message' => 'incorrect price'
                    ];
                }
                $product->setPrice($price);
            }
            $this->em->persist($product);
            $this->em->flush();
            return [
                'status' => 'ok',
                'message' => 'product with id='.$id.' updated'
            ];
        }else{
            return [
                'status' => 'faild',
                'message' => 'product with id='.$id.' not found'
            ];
        }
    }

    public function search($data): Array
    {
        $category = $data->category;
        $page = intval($data->page);
        $perPage = intval($data->perPage);

        if(is_array($category) && $page && $perPage)
        {
            $found = $this->em->getRepository(Product::class)->findBy( ['category' => $category]);
            $count = ($page-1)*$perPage;
            $pageResult = [];
            for($i=$count;$i<$count+$perPage && $i<count($found);$i++)
            {
                $pageResult[$i]['name'] = $found[$i]->getName();
                $pageResult[$i]['category'] = $found[$i]->getCategory();
                $pageResult[$i]['price'] = $found[$i]->getPrice();
            }
            return [
                'status' => 'ok',
                'message' => $pageResult
            ];
        }else{
            return [
                'status' => 'faild',
                'message' => 'incorrect data'
            ];
        }
    }

    public function getAllCategory()
    {
        $categorys = $this->em->getRepository(Product::class)->getAllCategory();
        $result = [];
        foreach($categorys as $category)
        {
            $categoryCount = $this->em->getRepository(Product::class)->getCategoryCount($category['category']);
            array_push($result, ['categoryName' => $category['category'], 'categoryCount' => $categoryCount]);
        }
        return $result;
    }

    private function stringValidation($name): String
    {
        if(is_string($name))
        {
            $name = strval($name);
        }
        if($name == '')
        {
            return 'error1';
        }
        if(strlen($name) > 255)
        {
            return 'error2';
        }

        return $name;
    }
}