Feature: Goggle command line usage

  Background:
    Given I am in a test dir

  Scenario:
    Given there is a file named "names.json" with contents from "names.json"
    When I execute goggle with arguments "get -i names.json"
    Then I should see formatted json
    """
    [
      {
        "id": 1,
        "name": "John Doe"
      },
      {
        "id": 2,
        "name": "Bart Slardibartfast"
      }
    ]
    """

  Scenario: get a single output
    Given there is a file named "names.json" with contents from "names.json"
    When I execute goggle with arguments "get -i names.json 0 name -o text"
    Then I should see
    """
    John Doe
    """

  Scenario: get a single output
    Given there is a file named "names.json" with contents from "names.json"
    When I execute goggle with arguments "get -i names.json 0"
    When I execute piped goggle with arguments "get -t json name -o text"
    Then I should see
    """
    John Doe
    """

  Scenario: Convert output from json to text
    Given there is a file named "names.json" with contents from "names.json"
    When I execute goggle with arguments "get -i names.json -o text"
    Then I should see
    """
    1	John Doe
    2	Bart Slardibartfast
    """

  Scenario: Convert output from json to yaml
    Given there is a file named "names.json" with contents from "names.json"
    When I execute goggle with arguments "get -i names.json -o yaml"
    Then I should see
    """
    -
        id: 1
        name: 'John Doe'
    -
        id: 2
        name: 'Bart Slardibartfast'
    """

  Scenario: Map by values
    Given there is a file named "names.json" with contents from "names.json"
    """
    [
      {"id": 1, "name": "John Doe"},
      {"id": 2, "name": "Bart Slardibartfast"}
    ]
    """
    When I execute goggle with arguments "process -i names.json mapBy 'id' map 'name'"
    Then I should see formatted json
    """
    {
      "1": "John Doe",
      "2": "Bart Slardibartfast"
    }
    """

  Scenario: Sort and map
    Given there is a file named "simpsons.json" with contents from "simpsons.json"
    When I execute goggle with arguments "process -i simpsons.json sortBy age map 'name' -o text"
    Then I should see
    """
    Maggie Simpson
    Lisa Simpson
    Bart Simpson
    Marge Simpson
    Homer Simpson
    """

  Scenario: Mapby and ksort
    Given there is a file named "simpsons.json" with contents from "simpsons.json"
    When I execute goggle with arguments "process -i simpsons.json mapBy 'age' ksort fields 'name' 'age' -o text "
    Then I should see
    """
    Maggie Simpson	2
    Lisa Simpson	9
    Bart Simpson	10
    Marge Simpson	43
    Homer Simpson	45
    """

  Scenario: Unique values
    Given there is a file named "simpsons.json" with contents from "simpsons.json"
    When I execute goggle with arguments "process -i simpsons.json unique 'role' map 'role' sort -o text"
    Then I should see
    """
    daughter
    father
    mother
    son
    """

  Scenario: Filter
    Given there is a file named "simpsons.json" with contents from "simpsons.json"
    When I execute goggle with arguments
    """
    process -i simpsons.json filter 'item["age"] > 40 and item["age"] < 44' fields role
    """"
    Then I should see formatted json
    """
    {
        "4": {
            "role": "mother"
        }
    }
    """


