<?php

if(!function_exists('get_input_french'))
{

    function get_input_french($string)
    {

        switch ($string) {

            case 'email':
                return 'email';
                break;

            case 'password':
                return 'mot de passe';
                break;

            case 'name':
                return 'nom';
                break;

            case 'surname':
                return 'prénom';
                break;

            case 'phone':
                return 'numéro de teléphone';
                break;

                case 'address':
                    return 'adresse';
                    break;

                    case 'media':
                        return 'fichier';
                        break;

                        case 'year':
                            return 'année';
                            break;

                            case 'description':
                                return 'description';
                                break;

                                case 'car_model_id':
                                    return 'modèle';
                                    break;

                                    case 'c_name':
                                        return 'nom complet';
                                        break;

                                        case 'role_id':
                                            return 'role';
                                            break;

                                            case 'pic':
                                                return 'photo';
                                                break;

                                                case 'bio':
                                                    return 'Biographie';
                                                    break;

                                                    case 'exp_date':
                                                        return 'date d\'expédition';
                                                        break;

                                                        case 'customer_id':
                                                            return 'client';
                                                            break;

                                                            case 'user_id':
                                                                return 'agent';
                                                                break;

                                                                case 'sale_price':
                                                                    return 'prix de vente';
                                                                    break;

                                                                    case 'sale_date':
                                                                        return 'date de  vente';
                                                                        break;

            default:
                # code...
                break;
        }

    }

    function input_array_scrawler(Array $array)
    {

        // $srawler = 0;
        $final = [];

        foreach($array as $name)
        {
            $final [] = get_input_french($name);
        }

        return $final;

    }

}

